const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.json({ limit: '10mb' }));

app.post('/rank', (req, res) => {
    try {
        const { candidates, criteria, critere } = req.body;
        console.log('Received ranking request:', { candidates, criteria, critere });

        if (!candidates || !Array.isArray(candidates) || !criteria || !critere) {
            console.error('Invalid input:', { candidates, criteria, critere });
            return res.status(400).json({ error: 'Invalid input: candidates, criteria, and critere are required.' });
        }

        const results = candidates.map(candidate => {
            let score = 0;
            const features = {};

            // Technical Skills
            const techSkills = (candidate.competences_techniques || '').toLowerCase().split(',').map(s => s.trim()).filter(s => s);
            const requiredTech = (critere.competences_techniques || '').toLowerCase().split(',').map(s => s.trim()).filter(s => s);
            const techMatch = techSkills.filter(skill => requiredTech.includes(skill)).length;
            score += criteria.poids_competence_technique * (requiredTech.length ? techMatch / requiredTech.length : 0);
            features.technical_skills = techMatch;

            // Linguistic Skills
            const langSkills = (candidate.competences_linguistiques || '').toLowerCase().split(',').map(s => s.trim()).filter(s => s);
            const requiredLang = (critere.competences_linguistiques || '').toLowerCase().split(',').map(s => s.trim()).filter(s => s);
            const langMatch = langSkills.filter(lang => requiredLang.includes(lang)).length;
            score += criteria.poids_competence_linguistique * (requiredLang.length ? langMatch / requiredLang.length : 0);
            features.linguistic_skills = langMatch;

            // Managerial Skills
            const mgrSkills = (candidate.competences_manageriales || '').toLowerCase().split(',').map(s => s.trim()).filter(s => s);
            const requiredMgr = (critere.competences_manageriales || '').toLowerCase().split(',').map(s => s.trim()).filter(s => s);
            const mgrMatch = mgrSkills.filter(skill => requiredMgr.includes(skill)).length;
            score += criteria.poids_competence_manageriale * (requiredMgr.length ? mgrMatch / requiredMgr.length : 0);
            features.managerial_skills = mgrMatch;

            // Formation
            const formationMatch = critere.formation && Array.isArray(critere.formation) && candidate.formation ? 
                critere.formation.includes(candidate.formation) ? 1 : 0 : 0;
            score += criteria.poids_formation * formationMatch;
            features.formation = formationMatch;

            // Experience
            const expMatch = critere.experience ? Math.min(candidate.experience / critere.experience, 1) : 0;
            score += criteria.poids_experience * expMatch;
            features.experience = expMatch;

            return {
                score: Math.min(score / 100, 1),
                features,
                candidature_id: candidate.candidature_id,
            };
        });

        results.sort((a, b) => b.score - a.score);
        console.log('Ranking results:', results);
        res.json(results);
    } catch (error) {
        console.error('Error in /rank:', error.message, error.stack);
        res.status(500).json({ error: 'Internal server error: ' + error.message });
    }
});

app.listen(3000, () => {
    console.log('API running at http://localhost:3000');
});
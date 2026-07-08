const fs = require('fs');
const path = require('path');
const https = require('https');

const outputDir = path.join(__dirname, '..', 'output');

fs.readdir(outputDir, (err, files) => {
    if (err) throw err;
    const pumlFiles = files.filter(f => f.endsWith('.puml'));
    
    pumlFiles.forEach(file => {
        const pumlPath = path.join(outputDir, file);
        const pngPath = path.join(outputDir, file.replace('.puml', '.png'));
        
        const content = fs.readFileSync(pumlPath, 'utf8');
        
        const options = {
            hostname: 'kroki.io',
            port: 443,
            path: '/plantuml/png',
            method: 'POST',
            headers: {
                'Content-Type': 'text/plain',
                'Content-Length': Buffer.byteLength(content)
            }
        };

        const req = https.request(options, (res) => {
            if (res.statusCode === 200) {
                const fileStream = fs.createWriteStream(pngPath);
                res.pipe(fileStream);
                fileStream.on('finish', () => {
                    console.log(`Saved: ${pngPath}`);
                });
            } else {
                console.error(`Failed to generate ${file}: ${res.statusCode}`);
            }
        });

        req.on('error', (e) => {
            console.error(`Error with ${file}: ${e.message}`);
        });

        req.write(content);
        req.end();
    });
});

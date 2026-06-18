import qrcode from 'qrcode-terminal';
import os from 'os';
import { spawn } from 'child_process';

const interfaces = os.networkInterfaces();
let localIp = '127.0.0.1';
for (const name of Object.keys(interfaces)) {
    for (const iface of interfaces[name]) {
        // Skip virtual or WSL interfaces if possible, prioritize Wi-Fi or Ethernet
        if (iface.family === 'IPv4' && !iface.internal) {
            localIp = iface.address;
            if (name.toLowerCase().includes('wi-fi') || name.toLowerCase().includes('wlan')) {
                break;
            }
        }
    }
    if (localIp !== '127.0.0.1' && (name.toLowerCase().includes('wi-fi') || name.toLowerCase().includes('wlan'))) {
        break;
    }
}

const url = `http://${localIp}:8000`;
console.log(`\n\x1b[36m====================================================\x1b[0m`);
console.log(`\x1b[32m  📱 AKSES APLIKASI RT 08 DARI HP ANDA\x1b[0m`);
console.log(`\x1b[36m====================================================\x1b[0m\n`);
console.log(`  Pastikan HP dan Komputer terhubung di WiFi yang sama.`);
console.log(`  Scan QR Code ini dengan kamera HP Anda:\n`);

qrcode.generate(url, {small: true});

console.log(`\n  Atau buka URL ini di browser HP Anda:`);
console.log(`  \x1b[32m${url}\x1b[0m\n`);
console.log(`\x1b[33mMenjalankan Server Laravel (Port 8000) & Vite Assets...\x1b[0m\n`);

// Run artisan serve and vite concurrently
const artisan = spawn('php', ['artisan', 'serve', '--host=0.0.0.0', '--port=8000'], { stdio: 'inherit' });
const vite = spawn(/^win/.test(process.platform) ? 'npm.cmd' : 'npm', ['run', 'dev', '--', '--host', localIp], { stdio: 'inherit' });

process.on('SIGINT', () => {
    artisan.kill();
    vite.kill();
    process.exit();
});

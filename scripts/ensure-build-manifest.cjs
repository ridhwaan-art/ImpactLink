const fs = require('fs');
const path = require('path');

const source = path.resolve(__dirname, '../public/build/.vite/manifest.json');
const target = path.resolve(__dirname, '../public/build/manifest.json');

if (fs.existsSync(source)) {
    fs.copyFileSync(source, target);
    console.log(`Copied Vite manifest to ${path.relative(process.cwd(), target)}`);
} else {
    console.warn(`Vite manifest not found at ${path.relative(process.cwd(), source)}`);
}

import './bootstrap';

import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;

Alpine.start();

// Initialize Lucide Icons
document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});


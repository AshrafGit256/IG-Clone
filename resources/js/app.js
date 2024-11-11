import './bootstrap';

import { livewire_hot_reload } from 'virtual:livewire-hot-reload';
livewire_hot_reload();

import intersect from '@alpinejs/intersect';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
 
Alpine.plugin(intersect)
Alpine.start();

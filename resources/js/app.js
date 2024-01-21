import './script/main';

import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import Sortable from 'sortablejs';

window.Sortable = Sortable;

Alpine.plugin(mask)

window.Alpine = Alpine;

Alpine.start();
import './bootstrap';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.css'

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import TomSelect from "tom-select";
import flatpickr from "flatpickr";


window.TomSelect = TomSelect;

window.flatpickr = flatpickr;

window.Alpine = Alpine;

Alpine.plugin(focus);



Alpine.start();

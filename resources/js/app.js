require('./bootstrap');

import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'
import lgFullscreen from 'lightgallery/plugins/fullscreen'
import lgShare from 'lightgallery/plugins/share'
import lgRotate from 'lightgallery/plugins/rotate'
import lgAutoplay from 'lightgallery/plugins/autoplay'
import Datepicker from 'flowbite-datepicker/Datepicker'
import lang from 'flowbite-datepicker/locales/lv'

window.lightGallery = lightGallery;
window.lgThumbnail = lgThumbnail;
window.lgZoom = lgZoom;
window.lgFullscreen = lgFullscreen;
window.lgShare = lgShare;
window.lgRotate = lgRotate;
window.lgAutoplay = lgAutoplay;

window.lang = lang;
window.Datepicker = Datepicker;

import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'
import lgFullscreen from 'lightgallery/plugins/fullscreen'
import lgShare from 'lightgallery/plugins/share'
import lgRotate from 'lightgallery/plugins/rotate'
import lgAutoplay from 'lightgallery/plugins/autoplay'
import Datepicker from 'flowbite-datepicker/Datepicker'
import DateRangePicker from 'flowbite-datepicker/DateRangePicker'
import lang from 'flowbite-datepicker/locales/lv'
import * as FilePond from 'filepond'
import { Jodit } from 'jodit'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

window.lightGallery = lightGallery;
window.lgThumbnail = lgThumbnail;
window.lgZoom = lgZoom;
window.lgFullscreen = lgFullscreen;
window.lgShare = lgShare;
window.lgRotate = lgRotate;
window.lgAutoplay = lgAutoplay;

window.lang = lang;
window.Datepicker = Datepicker;
window.DateRangePicker = DateRangePicker;

FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginFileValidateSize);
FilePond.registerPlugin(FilePondPluginImagePreview);

window.FilePond = FilePond;
window.Jodit = Jodit;

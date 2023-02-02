import { ComponentsManager } from './libs/components_manager.js';
import { Query }             from './libs/query.js';
import { Basket }            from './libs/basket.js';
import { Wishes }            from './libs/wishes.js';
import { Messages }          from './libs/messages.js';
import { Utils }             from './libs/utils.js';

window.componentsManager = ComponentsManager;
window.query = new Query();
window.basket = new Basket();
window.wishes = new Wishes();
window.messages = new Messages();
window.utils = new Utils();

// console.debug(utils.Translit('38 / 80 см'));

// window.getCookie = function (name) {
//   var match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
//   if (match) return match[2];
// };
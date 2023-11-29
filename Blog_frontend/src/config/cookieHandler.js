// cookieService.js

import Cookies from 'js-cookie';

const cookieService = {
  // Cookie beállítása
  setCookie: (name, value, options = {}) => {
    Cookies.set(name, value, options);
  },

  // Cookie lekérése
  getCookie: (name) => {
    return Cookies.get(name);
  },

  // Cookie törlése
  removeCookie: (name) => {
    Cookies.remove(name);
  },
};

export default cookieService;

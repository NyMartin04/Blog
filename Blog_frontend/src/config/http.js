// apiService.js

import axios from 'axios';
import Cookie from "./cookieHandler.js"
const apiUrl = 'http://localhost/Blog/system/controller'; // A te API címedet itt kell megadnod

const apiService = {
  // Példa egy egyszerű GET kérésre
  fetchData: async (endpoint) => {
    try {
      const response = await axios.get(`${apiUrl}/${endpoint}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching data:', error);
      throw error;
    }
  },

  // Példa egy POST kérésre
  postData: async (endpoint, data) => {
    try {
        if (Cookie.getCookie("token")) {
          console.log("ez fut le ");
            const response = await axios.post(`${apiUrl}/${endpoint}`, data,{token:Cookie.getCookie("token")});
      return response.data;
        }else{
            const response = await axios.post(`${apiUrl}/${endpoint}`, data);
      return response.data;
        }
      
    } catch (error) {
      console.log('Error posting data:', error);
      throw error;
    }
  },

  // További kérések és szolgáltatások hozzáadhatók a szükségleteknek megfelelően
};

export default apiService;

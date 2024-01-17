import axios from 'axios';
import Cookie from "./cookieHandler.js";

const apiUrl = 'http://localhost/Blog/system/controller/main.php';

const apiService = axios.create({
  headers: {
    // 'Accept': 'application/json',
    // 'Content-Type': 'application/json'
  },
});

apiService.interceptors.request.use(
  (config) => {
    if (Cookie.getCookie("token")) {
      config.headers['token'] = Cookie.getCookie("token");
    }
    return config;
  },
  (error) => {
    console.error('Error in request interceptor:', error);
    return Promise.reject(error);
  }
);

apiService.interceptors.response.use(
  (response) => {
    return response.data;
  },
  (error) => {
    console.error('Error in response interceptor:', error);
    return Promise.reject(error);
  }
);


const dataHandler = {
  fetchDataAndHandle: async (endpoint) => {
    try {
      const data = await apiService.get(`/${endpoint}`);
      // Itt tedd meg azokat az adatkezeléseket, amiket a kapott adatokkal szeretnél végezni

      return data;
    } catch (error) {
      console.error('Error fetching and handling data:', error);
      throw error;
    }
  },

  postDataAndHandle: async (endpoint, postData) => {
    try {
      const response = await apiService.post(`${apiUrl}/${endpoint}`, postData);
      // Itt tedd meg azokat az adatkezeléseket, amiket a kapott válasszal szeretnél végezni
      return response;
    } catch (error) {
      console.error('Error posting and handling data:', error);
      throw error;
    }
  },
};

export default dataHandler;


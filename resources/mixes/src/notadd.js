import axios from 'axios';

axios.interceptors.response.use(response => response, error => {
    console.log(error);
    console.log(error.response);
    console.log(error.response.data);
});

export default {
    http: axios,
    instance: null,
};

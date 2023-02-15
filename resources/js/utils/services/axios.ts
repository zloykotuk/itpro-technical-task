import axios from "axios";

export const baseService = axios.create({
    baseURL: 'http://localhost/api',
});

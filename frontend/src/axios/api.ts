import axios from "axios";

const api = axios.create({
  baseURL: "http://[::1]:2000/api/",
  withCredentials: true,
  withXSRFToken: true,
});

export default api;

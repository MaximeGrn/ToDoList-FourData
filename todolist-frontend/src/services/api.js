import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api/", // URL de base de ton API Laravel
    // Autres options d'Axios (en-têtes, etc.) si nécessaire
});

export default api;

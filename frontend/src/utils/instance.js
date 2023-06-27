import axios from "axios";

export const ApiInstance = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: { Accept: "application/json" },
    withCredentials: true,
});
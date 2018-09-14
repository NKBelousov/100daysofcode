import axios from "axios";

const axiosInstance = window.axios || axios;

export default class Service {
    constructor(base) {
        if (typeof base !== "string" || base === "") {
            throw new Error("Service::В качестве базового URL ожидалась строка")
        }
        this.base = base;
        this.http = axiosInstance;
    }
    get(id) {
        return this.http.get(`${this.base}/${id}`).then(response => response.data);
    }
    delete(id) {
        return this.http.delete(`${this.base}/${id}`).then(response => response.data);
    }
    save(payload) {
        const { id } = payload;
        const isNew = typeof id !== "string" || id === "";
        const url = isNew ? this.base : `${this.base}/${id}`;
        const method = isNew ? "POST" : "PUT";
        return this.http.request({
            method,
            data: payload,
            url,
        }).then(response => response.data);
    }
    list() {
        return this.http.get(`${this.base}`).then(response => response.data);
    }
};
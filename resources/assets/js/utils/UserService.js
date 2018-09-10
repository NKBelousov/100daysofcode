import Service from "./Service";

class UserService extends Service {
    current() {
        return this.http.get(`/api/user/current`);
    }
}

export default new UserService(`/api/user`);
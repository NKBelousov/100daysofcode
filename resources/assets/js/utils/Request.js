import deepFreeze from "./../helpers/deepFreeze";

export const DEFAULT = deepFreeze({
    page: 1,
    perPage: 10,
    search: "",
});

export default class Request {
    constructor(config = {}) {
        this.query = {
            page: config.page || DEFAULT.page,
            perPage: config.perPage || DEFAULT.perPage,
            search: config.search || DEFAULT.search,
        }
    }
    page(index) {
        this.query.page = index;
        return this;
    }
    prevPage() {
        this.query.page = Math.max(this.query.page - 1, 0);
        return this;
    }
    nextPage() {
        this.query.page = Math.min(this.query.page + 1, Number.MAX_SAFE_INTEGER);
        return this;
    }
    perPage(count) {
        this.query.perPage = count;
        return this;
    }
    search(what) {
        this.query.search = what;
        return this;
    }
    toQuery() {
        return this.query;
    }
};
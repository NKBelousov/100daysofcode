export const DEFAULT = Object.freeze({
  search: "",
  page: 1,
  perPage: 10,
  sortBy: "created_at",
  orderBy: "desc",
});

export default class Request {
  constructor(config = {}) {
    this.query = {
      ...DEFAULT,
      ...config,
    };
  }
  page(index) {
    this.query.page = index;
    return this;
  }
  prevPage() {
    this.query.page = Math.max(this.query.page - 1, 1);
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
  sortBy(what, direction) {
    this.query.sortBy = what;
    this.query.orderBy = direction;
    return this;
  }
  toQuery() {
    return this.query;
  }
}
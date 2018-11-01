import Request from "./Request";

it("should export Request class", () => {
  expect(typeof Request).toBe("function");
});

it("should create instances without config", () => {
  const request = new Request();
  expect(request instanceof Request).toBe(true);
});

it("should have methods to change payload", () => {
  const request = new Request();
  expect(typeof request.nextPage).toBe("function");
  expect(typeof request.page).toBe("function");
  expect(typeof request.perPage).toBe("function");
  expect(typeof request.prevPage).toBe("function");
  expect(typeof request.search).toBe("function");
});

it("instances should have chaining API", () => {
  const request = new Request();
  expect(request).toBe(request.nextPage());
  expect(request).toBe(request.page());
  expect(request).toBe(request.perPage());
  expect(request).toBe(request.prevPage());
  expect(request).toBe(request.search());
});
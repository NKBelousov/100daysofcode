import Service from "./Service";

it("should export Service class", () => {
  expect(typeof Service).toBe("function");
});

it("should throw exception without base url", () => {
  const f = () => {
    const service = new Service();
    return service;
  };
  expect(f).toThrow();
});

it("should create instance with provided base url", () => {
  const service = new Service("/api");
  expect(service).toBeInstanceOf(Service);
});

it("should provide CRUD operations", () => {
  const service = new Service("/api");
  expect(typeof service.get).toBe("function");
  expect(typeof service.delete).toBe("function");
  expect(typeof service.save).toBe("function");
  expect(typeof service.list).toBe("function");
});
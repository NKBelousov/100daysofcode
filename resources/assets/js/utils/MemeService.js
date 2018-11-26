import Service from "./Service";

class MemeService extends Service {
  async save(payload) {
    const data = {
      title: payload.title,
      description: payload.description,
    };
    const meme = await super.save(payload);
    if (payload.tags.length > 0) {
      await this.updateTags(meme.id, payload.tags);
    }
    return meme;
  }
  updateTags(memeId, tags) {
    return this.http.request({
      data: tags,
      method: "PATCH",
      url: `/api/meme/${memeId}/tags`,
    }).then(response => response.data);
  }
}

export default new MemeService(`/api/meme`);
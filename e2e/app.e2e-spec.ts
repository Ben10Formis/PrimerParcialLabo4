import { TablaPage } from './app.po';

describe('tabla App', () => {
  let page: TablaPage;

  beforeEach(() => {
    page = new TablaPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});

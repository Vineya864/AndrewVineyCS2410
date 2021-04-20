class Footer extends HTMLElement {
  constructor() {
    super();
  }
  
  connectedCallback() {
    this.innerHTML = `
	
	<footer id="page-footer"> example@email-address.com <br/>
	 <a href="https://facebook.com">
         <img alt="facebook_Link" src="css/facebookPhoto.png"
         width="15" height="15">
      </a>
	  <a href="https://twitter.com">
         <img alt="twitter_Link" src="css/twitterPhoto.png"
         width="15" height="15">
      </a>
	  
	<br/>
	Copyright_Lorem ipsum dolor sit amet,<br/> consectetur adipiscing elit. Morbi massa nibh,<br/> semper scelerisque diam id, facilisis convallis eros.   <br/> </footer>
	
	
	
	`;
  }
}



customElements.define('footer-component', Footer);
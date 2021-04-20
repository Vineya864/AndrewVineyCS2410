class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
     <header id="page-header"> <a href="/adoptionWeb.html">Aston animal sanctuary</a> 
	<section id="log-in"> 
		<a href="login.php">
		<button>Log In</button>
		</a>
	</section>
	<section id="nav-bar">
			<div class="container">
			 <div class="row">
        <div class="nav-1"><a href="adoptionWeb.html">Home</a></div>
        <div class="nav-2 col-md-6"><a href="allAnimals.php">See Animals</a></div>
        <div class="nav-3 col-md-6"><a href="AccountPage.php">My Account</a></div>
      </div>
	  </div>
	</section>
	
	</header>
    `;
  }
}

customElements.define('header-component', Header);
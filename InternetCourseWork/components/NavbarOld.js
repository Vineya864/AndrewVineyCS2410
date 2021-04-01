class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
     <header id="page-header"> <a href="adoptionWeb.html">Adoption Website</a> 
	<form id="log-in"><input type="Email"
	placeholder="Valid Email Address"
	required
	pattern=".+(\.com|\.edu|\.ac\.uk)"
	title="email" />
	<input type="password"
          placeholder="Password"
          required 
		  title="password"/>
   
	<input type="submit"
        value="Sign In" />
	
	</form>
	<section id="nav-bar">
			<div class="container">
			 <div class="row">
        <div class="nav-1"><a href="adoptionWeb.html">Home</a></div>
        <div class="nav-2 col-md-6"><a href="dashboard.php">Dashboard</a></div>
        
      </div>
	  </div>
	</section>
	
	</header>
    `;
  }
}

customElements.define('header-component', Header);
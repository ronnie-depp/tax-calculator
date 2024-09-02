
    <!-- Hero Section -->
    <section id="home" class="hero d-flex align-items-center">
      <div class="hero-overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-6 hero-content text-white">
            <h1>Welcome to the Future of Tax Services</h1>
            <p>
              Streamline your tax filing with our advanced and reliable
              services.
            </p>
            <a href="#services" class="btn btn-primary">Explore Services</a>
          </div>
          <div class="col-md-6">
            <!-- Updated Form Structure -->
            <div class="main mx-auto">
              <input type="checkbox" id="chk" aria-hidden="true" />

              <div class="signup">
                <form method='post' action='/register'>
                  @csrf
                  <label for="chk" aria-hidden="true">Sign up</label>
                  <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    required=""
                  />
                  <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required=""
                  />
                  <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required=""
                  />
                  <input
                    type="password"
                    name="confirmpassword"
                    placeholder="Confirm Password"
                    required=""
                  />
                  <button>Sign up</button>
                </form>
              </div>

              <div class="login">
                <form method='post' action='/login'>
                  @csrf
                  <label for="chk" aria-hidden="true">Login</label>
                  <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required=""
                  />
                  <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required=""
                  />
                  <button>Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
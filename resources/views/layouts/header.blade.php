<div class="container">
    <nav class="navbar">
        <div class="navbar-brand">
            <router-link to="/" class="navbar-item">
                <img src="{{asset('img/dog-social.png')}}" alt="DogSocial">
            </router-link>

            <div class="navbar-burger burger" @click="onToggleMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="nav-menu-header" class="navbar-menu" :class="{'is-active': mobileMenu}">
            <div class="navbar-start">

                <router-link v-if="isLoggedIn" :to="{ name: 'posts.index' }" class="navbar-item" exact>
                    <span class="bd-emoji">⭐️</span>
                    Feed
                </router-link>

                <router-link v-if="isLoggedIn" :to="{ name: 'profile.my_posts' }" class="navbar-item" exact>
                    My Posts
                </router-link>

                <a href="#" v-if="isLoggedIn" class="navbar-item" @click="logout">Logout</a>

                <router-link v-if="!isLoggedIn" :to="{ name: 'auth.login' }" class="navbar-item" exact>
                    Login / Signup
                </router-link>

            </div>

        </div>
    </nav>
</div>
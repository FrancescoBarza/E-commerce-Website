<section>
    <h1>CIAO <?php echo htmlspecialchars($templateParams["nome"]); ?>!</h1> 
            <div class="cliente">
                <div class="card">
                    <svg viewBox="0 0 93.842 93.843">
                        <path fill="currentColor" d="M74.042,11.379h-9.582v-0.693c0-1.768-1.438-3.205-3.206-3.205h-6.435V3.205C54.819,1.437,53.381,0,51.614,0H42.23
		c-1.768,0-3.206,1.438-3.206,3.205V7.48H32.59c-1.768,0-3.206,1.438-3.206,3.205v0.693h-9.582c-2.393,0-4.339,1.945-4.339,4.34
		v73.785c0,2.394,1.946,4.34,4.339,4.34h54.238c2.394,0,4.339-1.946,4.339-4.34V15.719C78.38,13.324,76.434,11.379,74.042,11.379z
		 M32.617,25.336h28.61c1.709,0,3.102-1.391,3.102-3.1v-3.438h7.554l0.021,68.164l-49.939,0.021V18.801h7.554v3.436
		C29.517,23.945,30.907,25.336,32.617,25.336z" />
                    </svg>
                    <a href="./datiUtente.html">I miei dati</a>
                </div>
                <div class="card">
                    <svg viewBox="0 0 485.32 485.32">
                        <g>
                            <path fill="currentColor"
                                d="m480.76,79.05c-0.6-0.2-235-78.3-235-78.3-2.1-1-4.1-1-6.2,0l-231.9,76.3c-5.8,2.4-7.2,7.4-7.2,10.3v313.3c0,5.2 3.1,9.3 7.2,10.3l229,73.2c3.5,1.3 7.3,1.8 12.1,0l228.9-73.2c4.1-2.1 7.2-6.2 7.2-10.3v-313.3c5.68434e-14-3.1-1-6.2-4.1-8.3zm-238.1-56.7l198.9,63.9-75.1,24.1-196-64.5 72.2-23.5zm-10.3,438l-211.3-67v-291.4l211.3,67.6v290.8zm10.3-310.2l-198.9-62.8 93.7-30.6 195.3,64.5-90.1,28.9zm10.3,310.2v-291.6l105.1-33.3v32.3l20.6-8.8v-30l85.5-27v290.4h0.1l-211.3,68z" />
                        </g>
                    </svg>
                    <a href="./ordiniPassati.html">I miei ordini</a>
                </div>
                <div class="card">
                    <svg viewBox="0 0 611.999 611.999">
                        <path fill="currentColor" d="M570.107,500.254c-65.037-29.371-67.511-155.441-67.559-158.622v-84.578c0-81.402-49.742-151.399-120.427-181.203
				C381.969,34,347.883,0,306.001,0c-41.883,0-75.968,34.002-76.121,75.849c-70.682,29.804-120.425,99.801-120.425,181.203v84.578
				c-0.046,3.181-2.522,129.251-67.561,158.622c-7.409,3.347-11.481,11.412-9.768,19.36c1.711,7.949,8.74,13.626,16.871,13.626
				h164.88c3.38,18.594,12.172,35.892,25.619,49.903c17.86,18.608,41.479,28.856,66.502,28.856
				c25.025,0,48.644-10.248,66.502-28.856c13.449-14.012,22.241-31.311,25.619-49.903h164.88c8.131,0,15.159-5.676,16.872-13.626
				C581.586,511.664,577.516,503.6,570.107,500.254z M484.434,439.859c6.837,20.728,16.518,41.544,30.246,58.866H97.32
				c13.726-17.32,23.407-38.135,30.244-58.866H484.434z M306.001,34.515c18.945,0,34.963,12.73,39.975,30.082
				c-12.912-2.678-26.282-4.09-39.975-4.09s-27.063,1.411-39.975,4.09C271.039,47.246,287.057,34.515,306.001,34.515z
				 M143.97,341.736v-84.685c0-89.343,72.686-162.029,162.031-162.029s162.031,72.686,162.031,162.029v84.826
				c0.023,2.596,0.427,29.879,7.303,63.465H136.663C143.543,371.724,143.949,344.393,143.97,341.736z M306.001,577.485
				c-26.341,0-49.33-18.992-56.709-44.246h113.416C355.329,558.493,332.344,577.485,306.001,577.485z" />
                        <path d="M306.001,119.235c-74.25,0-134.657,60.405-134.657,134.654c0,9.531,7.727,17.258,17.258,17.258
				c9.531,0,17.258-7.727,17.258-17.258c0-55.217,44.923-100.139,100.142-100.139c9.531,0,17.258-7.727,17.258-17.258
				C323.259,126.96,315.532,119.235,306.001,119.235z" />
                    </svg>
                    <a href="./notifiche.html">Notifiche</a>
                </div>
            </div>
            <button type="button" class="logout" onclick="confirmLogout()">Logout</button>
                <script>
                    function confirmLogout() {
                    if (confirm('Sei sicuro di voler uscire?')) {
                    window.location.href = 'areaCliente.php?logout=true';
                    }
                    }
                </script>
 </section>
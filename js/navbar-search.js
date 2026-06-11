const navbarSearchInput =
document.getElementById('navbarSearchInput');

const navbarSearchResult =
document.getElementById('navbarSearchResult');

if(navbarSearchInput){

    navbarSearchInput.addEventListener('keyup',function(){

        let q = this.value.trim();

        if(q.length < 2){

            navbarSearchResult.style.display='none';
            navbarSearchResult.innerHTML='';

            return;
        }

        fetch(
            'ajax/navbar-search.php?q=' +
            encodeURIComponent(q)
        )

        .then(res => res.text())

        .then(data => {

            navbarSearchResult.innerHTML = data;

            navbarSearchResult.style.display =
                data.trim() ? 'block' : 'none';

        });

    });

    document.addEventListener('click',function(e){

        if(!e.target.closest('.top-search')){

            navbarSearchResult.style.display='none';

        }

    });

}
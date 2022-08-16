function showOrHide(bloggood, cat) {
            bloggood = document.getElementById(bloggood);
            cat = document.getElementById(cat);
            if (bloggood.checked) cat.style.display = "block";
            else cat.style.display = "none";
             }

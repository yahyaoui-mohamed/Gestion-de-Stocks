quantite = document.getElementById("qu"),
  prix = document.getElementById("pu"),
  totale = document.getElementById("totale"),
  quantitemod = document.getElementById("quantite"),
  prixmod = document.getElementById("prix"),
  prixt = document.getElementById("prixtotale");

if (quantitemod) {
  quantitemod.oninput = function () {
    prixt.value = (+prixmod.value * +this.value) + "DT";
  }
}


if (prixmod) {
  prixmod.oninput = function () {
    prixt.value = (+quantitemod.value * +this.value) + "DT";
  }
}

if (quantite) {
  quantite.oninput = function () {
    totale.value = (+prix.value * +this.value) + "DT";
  }
}

if (prix) {
  prix.oninput = function () {
    totale.value = (+quantite.value * +this.value) + "DT";
  }
}

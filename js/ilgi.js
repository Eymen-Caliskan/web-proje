const oyunlarDiv = document.getElementById("oyunlar");

// Slug listesi
const oyunSluglari = [
  "counter-strike-2-2",
  "the-last-of-us-part-i",
  "bloodborne",
  "minecraft",
  "undertale",
  "red-dead-redemption-2"
];

function kisalt(metin, uzunluk = 150) {
  if (!metin) return "Açıklama bulunamadı.";
  return metin.length > uzunluk ? metin.substring(0, uzunluk).trim() + "..." : metin;
}

function toggleAciklama(id, tamMetin, kisaltMetin) {
  const p = document.getElementById(`ozet-${id}`);
  const gosterildi = p.getAttribute("data-gosterildi") === "true";

  if (gosterildi) {
    p.innerHTML = `
      ${kisaltMetin}
      <span class="text-primary fw-bold" style="cursor:pointer;display:block;" onclick="toggleAciklama(${id}, \`${tamMetin.replace(/`/g, "\\`")}\`, \`${kisaltMetin.replace(/`/g, "\\`")}\`)"> Devamını Göster</span>
    `;
    p.setAttribute("data-gosterildi", "false");
  } else {
    p.innerHTML = `
      ${tamMetin}
      <span class="text-primary fw-bold" style="cursor:pointer;display:block;" onclick="toggleAciklama(${id}, \`${tamMetin.replace(/`/g, "\\`")}\`, \`${kisaltMetin.replace(/`/g, "\\`")}\`)"> Daha Az Göster</span>
    `;
    p.setAttribute("data-gosterildi", "true");
  }
}

oyunSluglari.forEach(slug => {
  fetch(`https://api.rawg.io/api/games/${slug}?key=c85e5418b07841bda46b3c2480b8994c`)
    .then(res => res.json())
    .then(oyun => {
      const tamAciklama = oyun.description_raw || "Açıklama yok.";
      const kisaltAciklama = kisalt(tamAciklama);

      const div = document.createElement("div");
      div.className = "col-md-4";
      div.innerHTML = `
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="css/ilgi.css" />  
        </head>
        <body>
        <div class="oyun-kart">
          <img src="${oyun.background_image}"  alt="${oyun.name}">
          <div class="card-body">
            <h5 class="card-title">${oyun.name}</h5>
            <p class="card-text oyun-aciklama" id="ozet-${oyun.id}" data-gosterildi="false">
              ${kisaltAciklama}
              <span class="text-primary fw-bold" style="cursor:pointer;display:block;" onclick="toggleAciklama(${oyun.id}, \`${tamAciklama.replace(/`/g, "\\`")}\`, \`${kisaltAciklama.replace(/`/g, "\\`")}\`)"> Devamını Göster</span>
            </p>
          </div>
        </div>
        </body>
      `;
      oyunlarDiv.appendChild(div);
    });
});

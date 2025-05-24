const oyunlarDiv = document.getElementById("oyunlar");

// RAWG API Key ve endpoint
const RAWG_API_KEY = 'c85e5418b07841bda46b3c2480b8994c'; // API anahtarınızı buraya ekleyin
const RAWG_API_URL = 'https://api.rawg.io/api/games';

// Favori oyunların ID'leri ve slug'ları
const favoriteGames = [
  { id: 731297, slug: "counter-strike-2-2" },     // CS2
  { id: 501873, slug: "the-last-of-us-part-i" },  // The Last of Us Part I
  { id: 2115, slug: "bloodborne" },               // Bloodborne
  { id: 22509, slug: "minecraft" },               // Minecraft
  { id: 28725, slug: "undertale" },               // Undertale
  { id: 28, slug: "red-dead-redemption-2" }       // Red Dead Redemption 2
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
            <span class="text-primary fw-bold" style="cursor:pointer;display:block;" onclick="toggleAciklama(${id}, \`${tamMetin.replace(/`/g, "\\`")}\`, \`${kisaltMetin.replace(/`/g, "\\`")}\`)">Devamını Göster</span>
        `;
    p.setAttribute("data-gosterildi", "false");
  } else {
    p.innerHTML = `
            ${tamMetin}
            <span class="text-primary fw-bold" style="cursor:pointer;display:block;" onclick="toggleAciklama(${id}, \`${tamMetin.replace(/`/g, "\\`")}\`, \`${kisaltMetin.replace(/`/g, "\\`")}\`)">Daha Az Göster</span>
        `;
    p.setAttribute("data-gosterildi", "true");
  }
}

// Oyunları getir ve göster
async function fetchAndDisplayGames() {
  try {
    const gamesContainer = document.getElementById('games-container');

    for (const game of favoriteGames) {
      const response = await fetch(`${RAWG_API_URL}/${game.slug}?key=${RAWG_API_KEY}`);
      const gameData = await response.json();

      const gameCard = createGameCard(gameData);
      gamesContainer.innerHTML += gameCard;
    }
  } catch (error) {
    console.error('Oyunlar yüklenirken hata oluştu:', error);
  }
}

// Oyun kartı HTML'ini oluştur
function createGameCard(game) {
  const kisaltAciklama = kisalt(game.description_raw || "Açıklama bulunamadı.");
  const tamAciklama = game.description_raw || "Açıklama bulunamadı.";

  return `
        <div class="col-md-4 mb-4">
            <div class="oyun-kart">
                <img src="${game.background_image}" alt="${game.name}" class="game-image">
                <div class="card-body">
                    <h3 class="card-title">${game.name}</h3>
                    <p class="card-text oyun-aciklama" id="ozet-${game.id}" data-gosterildi="false">
                        ${kisaltAciklama}
                        <span class="text-primary fw-bold" style="cursor:pointer;display:block;" 
                              onclick="toggleAciklama(${game.id}, \`${tamAciklama.replace(/`/g, "\\`")}\`, \`${kisaltAciklama.replace(/`/g, "\\`")}\`)">
                            Devamını Göster
                        </span>
                    </p>
                    <div class="game-details">
                        <p><strong>Çıkış Tarihi:</strong> ${new Date(game.released).toLocaleDateString('tr-TR')}</p>
                        <p><strong>Puan:</strong> ${game.rating}/5</p>
                        <p><strong>Türler:</strong> ${game.genres.map(genre => genre.name).join(', ')}</p>
                    </div>
                    <div class="mt-3">
                        <a href="https://rawg.io/games/${game.slug}" target="_blank" class="btn btn-primary w-100">
                            Detayları Gör
                        </a>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Sayfa yüklendiğinde oyunları getir
document.addEventListener('DOMContentLoaded', fetchAndDisplayGames);

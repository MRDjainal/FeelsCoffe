// Toggle Class Active
let currentRequest = null;
let photos = [];
let navbarNav = document.querySelector(".navbar-nav");
let humburgerMenu = document.querySelector("#humburger-menu");
let tt;
const visibleItems = () => $(".gallery-item:not(.hidden)").toArray();

// Ketika di klik
humburgerMenu.addEventListener("click", function (e) {
  e.preventDefault();
  navbarNav.classList.toggle("active");
});
// Klik di luar nav

document.addEventListener("click", function (e) {
  if (!humburgerMenu.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

// Text Info
function showToast(msg) {
  const t = document.getElementById("toast");
  t.textContent = msg;
  t.classList.add("show");
  clearTimeout(tt);
  tt = setTimeout(() => t.classList.remove("show"), 1800);
}
function filterMenu(cat, btn) {
  // update tab styles
  document
    .querySelectorAll(".tab")
    .forEach((t) => t.classList.remove("active"));
  btn.classList.add("active");

  // show/hide cards
  document.querySelectorAll(".menu-card").forEach((card) => {
    const show = cat === "all" || card.dataset.cat === cat;
    card.classList.toggle("visible", show);
    if (show) {
      card.style.animation = "none";
      void card.offsetHeight;
      card.style.animation = "fadeUp 0.5s forwards";
    }
  });
}

function loadPage(url, addToHistory = true) {
  if (currentRequest) {
    currentRequest.abort();
  }

  currentRequest = $.get(url, function (response) {
    $("main").html(response);
    $(window).scrollTop(0);

    feather.replace();

    if (addToHistory) {
      history.pushState({ page: url }, "", "#" + url);
    }
    navbarNav.classList.remove("active");
  });
}

function addmodal(url) {
  $.ajax({
    url: url,
    method: "GET",
    success: function (response) {
      let el = $(response);

      $("main").append(el);

      setTimeout(() => {
        el.addClass("show");
      }, 10);

      feather.replace();
    },
  });
}

function closeModal(modal) {
  modal.removeClass("show");

  setTimeout(() => {
    modal.remove();
  }, 300);
}

function filterGallery(cat, btn) {
  document
    .querySelectorAll(".ftab")
    .forEach((t) => t.classList.remove("active"));
  btn.classList.add("active");
  let count = 0;
  document.querySelectorAll(".gallery-item").forEach((item) => {
    const show = cat === "all" || item.dataset.cat === cat;
    item.classList.toggle("hidden", !show);
    if (show) count++;
  });
  document.getElementById("statPhotos").textContent = count;
}

function setView(mode, btn) {
  document
    .querySelectorAll(".view-btn")
    .forEach((b) => b.classList.remove("active"));
  btn.classList.add("active");
  const grid = document.getElementById("galleryGrid");
  if (mode === "grid") {
    grid.classList.remove("masonry-grid");
    grid.classList.add("grid-view");
  } else {
    grid.classList.remove("grid-view");
    grid.classList.add("masonry-grid");
  }
}

function renderLb() {
  const p = photos[lbIndex];

  if (!p) {
    console.log("Data tidak ditemukan:", lbIndex);
    return;
  }
  document.querySelector(".img-feelscoffee").src = p.image;
  document.getElementById("lbTitle").textContent = p.title;
  document.getElementById("lbMeta").textContent = p.cat + "|" + p.titlecategory;
  document.getElementById("lbDesc").textContent = p.desc;
  const vis = visibleItems();
  const pos = vis.findIndex((i) => +i.dataset.idx === lbIndex);
  document.getElementById("lbCurr").textContent = pos + 1;
  document.getElementById("lbTotal").textContent = vis.length;
}

$(document).ready(function () {
  window.onpopstate = function (event) {
    if (event.state && event.state.page) {
      loadPage(event.state.page, false);
    } else {
      loadPage("index.php", false);
    }
  };
  $(document).on("click", ".nav-link", function (e) {
    e.preventDefault();
    let pageUrl = $(this).data("page");
    loadPage(pageUrl);
  });
  // filter Tab menu
  $(document).on("click", ".tab", function () {
    filterMenu($(this).data("cat"), this);
  });

  // Filter tab galery

  $(document).on("click", ".ftab", function () {
    filterGallery($(this).data("cat"), this);
  });

  // filter galery view

  $(document).on("click", ".view-btn", function () {
    setView($(this).data("mode"), this);
  });
  // preview image

  $(document).on("click", ".preview-image", function () {
    let src = $(this).attr("src");

    $("#previewImg").attr("src", src);
    $("#imagePreviewModal").addClass("show").fadeIn();
  });

  // tombol close
  $(document).on("click", ".close-preview", function () {
    $("#imagePreviewModal").fadeOut();
  });

  // klik dimana saja
  $(document).on("click", "#imagePreviewModal", function (e) {
    if (e.target.id === "imagePreviewModal") {
      $(this).fadeOut();
    }
  });

  // btn add menu
  $(document).on("click", ".add-menu-btn", function (e) {
    e.preventDefault();
    addmodal("backend/addmenu.php");
  });

  // btn edit menu
  $(document).on("click", ".menu-card-crud .edit", function (e) {
    e.preventDefault();
    let id = $(this).data("id");

    $.ajax({
      url: "backend/addmenu.php",
      method: "POST",
      data: { id: id },
      success: function (response) {
        let el = $(response);
        $("main").append(el);

        setTimeout(() => {
          el.addClass("show");
        }, 10);

        feather.replace();
      },
    });
  });

  // btn save Menu
  $(document).on("click", ".btn-save-menu", function () {
    let id = $("#id").val();
    let role = id ? "edit_menu" : "tambah_menu";
    let nama = $("#nameCoffee").val().trim();
    let kategori = $("#category").val();
    let deskripsi = $("#descCoffee").val().trim();
    let strength = $("#strength").val().trim();
    let harga = $("#price").val().trim();
    let visualcoffee = $("#visualcoffee").val().trim();
    let image = $("#imagecoffee")[0].files[0];
    let old_image = $("#old_image").val();

    if (!id) {
      console.log("tidak ada id");
    }

    if (!nama) {
      alert("Nama Belum di isi");
      return;
    }
    if (!kategori) {
      alert("Kategori Belum di isi");
      return;
    }
    if (!deskripsi) {
      alert("Deskripsi Belum di isi");
      return;
    }
    if (!strength) {
      alert("Kekuatan Belum di isi");
      return;
    }
    if (strength < 10 || strength > 100) {
      alert("Kekuatan Harus dari 10 - 100%");
      return;
    }
    if (!harga) {
      alert("Harga Belum di isi");
      return;
    }
    if (!visualcoffee) {
      alert("Visual Belum di isi");
      return;
    }

    let formData = new FormData();
    formData.append("id", id);
    formData.append("role", role);
    formData.append("namecoffee", nama);
    formData.append("category", kategori);
    formData.append("desccoffee", deskripsi);
    formData.append("strength", strength);
    formData.append("price", harga);
    formData.append("visualcoffee", visualcoffee);
    formData.append("image", image);
    formData.append("old_image", old_image);

    $.ajax({
      url: "backend/crud.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == "success") {
          showToast("Data berhasil disimpan!");
          $("main").fadeOut(200, function () {
            $(this).load("page/menu.php", function () {
              $(this).fadeIn(200);
            });
          });
        } else {
          alert("Gagal menyimpan data!" + response);
        }
      },
    });
  });

  // delete menu
  $(document).on("click", ".menu-card-crud .delete", function (e) {
    e.preventDefault();
    if (!confirm("Apakah anda mau hapus menu ini?")) return;

    let id = $(this).data("id");
    $.ajax({
      url: "backend/crud.php",
      method: "POST",
      data: { id: id, role: "hapus_menu" },
      success: function (response) {
        if (response == "success") {
          $(".menu-card[data-id='" + id + "']").fadeOut(500, function () {
            $(this).remove();
          });
          showToast("Data berhasil dihapus");
        } else {
          showToast("Error: " + response);
        }
      },
    });
  });

  $(document).on("click", "#closeModal", function () {
    closeModal($(this).closest(".modal"));
  });

  // click di mana saja bagian modal add menu
  $(document).on("click", ".modal", function (e) {
    if ($(e.target).is(".modal")) {
      closeModal($(this));
    }
  });

  // Galery

  $(document).on("click", ".galery-section-add .btn-add-galery", function (e) {
    e.preventDefault();
    $.ajax({
      url: "backend/addgalery.php",
      method: "GET",
      success: function (response) {
        let el = $(response);
        $("main").append(el);
        setTimeout(() => {
          el.addClass("show");
        }, 10);

        feather.replace();
      },
    });
  });

  $(document).on("click", ".btn-save-galery", function () {
    let id = $("#id").val();
    let role = id ? "edit_gallery" : "tambah_gallery";
    let title = $("#titleImage").val().trim();
    let kategoriimage = $("#categoryImage").val();
    let kategoriTitleimage = $("#titleImagekategory").val();
    let descImage = $("#descImage").val().trim();
    let imageInput = $("#imageCoffee")[0];
    let image = imageInput.files[0];
    let old_image = $("#old_image").val();

    console.log(role);
    if (!id) {
      console.log("id gak ada coii");
    }

    if (!title) {
      alert("Title gambar tidak boleh kosong!");
      return;
    }
    if (!kategoriimage) {
      alert("Kategori gambar tidak boleh kosong!");
      return;
    }
    if (!kategoriTitleimage) {
      alert("Title kategori gambar tidak boleh kosong!");
      return;
    }
    if (!descImage) {
      alert("Deskripsi gambar tidak boleh kosong!");
      return;
    }
    if (!id && !image) {
      alert("Gambar tidak boleh kosong!");
      return;
    }

    let formData = new FormData();

    formData.append("id", id);
    formData.append("role", role);
    formData.append("titleimage", title);
    formData.append("categoryimage", kategoriimage);
    formData.append("titlecategory", kategoriTitleimage);
    formData.append("descimage", descImage);
    formData.append("image", image);
    formData.append("old_image", old_image);

    $.ajax({
      url: "backend/crud.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == "success") {
          alert("Data Berhasil Di simpan!");
          $("main").fadeOut(200, function () {
            $(this).load("page/galery.php", function () {
              $(this).fadeIn(200);
              feather.replace();
            });
          });
        } else {
          alert("Gagal menyimpan data!" + response);
        }
      },
    });
  });

  $(document).on("click", ".photo-frame", function () {
    lbIndex = $(this).data("idx");
    console.log(lbIndex);

    $.ajax({
      url: "backend/getgallery.php",
      method: "GET",
      dataType: "json",
      success: function (response) {
        photos = response;
        renderLb();

        document.getElementById("lightbox").classList.add("open");
        document.body.style.overflow = "hidden";
      },
      error: function (xhr, status, error) {
        console.log("ERROR:", status, error);
        console.log("RESPONSE:", xhr.responseText);
      },
    });
  });

  $(document).on("click", ".lb-close", function () {
    $(".lightbox").removeClass("open");
    $("body").css("overflow", "");
  });

  $(document).on("click", "#lightbox", function (e) {
    if (e.target === this) {
      $(".lightbox").removeClass("open");
      $("body").css("overflow", "");
    }
  });

  $(document).on("click", ".lb-nav", function () {
    let dir = $(this).data("lbnav");
    const vis = visibleItems();
    const pos = vis.findIndex((i) => +i.dataset.idx === lbIndex);
    const next = (pos + dir + vis.length) % vis.length;
    lbIndex = +vis[next].dataset.idx;
    renderLb();
  });

  $(document).on("click", ".gallery-item .edit", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    $.ajax({
      url: "backend/addgalery.php",
      method: "POST",
      data: { id: id },
      success: function (response) {
        let element = $(response);
        $("main").append(element);

        setTimeout(() => {
          element.addClass("show");
        }, 10);

        feather.replace();
      },
    });
  });

  $(document).on("click", ".gallery-item .delete", function (e) {
    e.preventDefault();
    if (!confirm("Apakah anda mau hapus gambar ini?")) return;
    let id = $(this).data("id");

    $.ajax({
      url: "backend/crud.php",
      method: "POST",
      data: { id: id, role: "delete_gallery" },
      success: function (response) {
        if (response == "success") {
          $(".gallery-item[data-id='" + id + "']").fadeOut(500, function () {
            $(this).remove();
          });
          alert("Data Berhasil dihapus");
        } else {
          alert("Error: " + response);
        }
      },
    });
  });

  // User Click box

  $(document).on("click", ".user-box", function (e) {
    e.preventDefault();
    $(".user-dropdown").toggleClass("show");
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".user-wrapper").length) {
      $(".user-dropdown").removeClass("show");
    }
  });

  $(document).on("click", "#logoutBtn", function (e) {
    e.preventDefault();

    $.ajax({
      url: "login/logout.php",
      type: "POST",
      success: function () {
        showToast("👋 Berhasil logout");

        setTimeout(() => {
          window.location.href = "index.php";
        }, 1000);
      },
    });
  });

  $(document).on("click", ".user-login", function (e) {
    e.preventDefault();
    showToast("loading....");
    setTimeout(() => {
      window.location.href = "login/indexlogin.php";
    }, 1000);
  });
});

<style>
.dropbtn {
  background-color: #555555;
  color: white;
  padding: 10px;
  font-size: 19px;
  border: none;
  cursor: pointer;
  width: 350px;
  border-radius: 10px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: black;
  width: 350px;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 10px;
}

.dropdown-content a {
  color: black;
  padding: 10px 15px;
  text-decoration: none;
  display: block;
  border-radius: 10px;
}

</style>

<div class="row justify-content-center align-items-center">
    <div class="col-md-3">
        <div class="mb-5">
            <button class="dropbtn" onclick="toggleCategoryDropdown()">Chọn loại hạng mục <i style="margin-left: 10px; font-size: 20px;" class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content" id="CategoryDropdown">
                <?php getcategories() ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-5">
            <button class="dropbtn" onclick="toggleBrandDropdown()">Chọn địa điểm nhà đất bán <i style="margin-left: 10px; font-size: 20px;" class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content" id="BrandDropdown">
                <?php getbrands() ?>
            </div>
        </div>
    </div>
</div>

<script>
function toggleCategoryDropdown() {
  var dropdownContent = document.getElementById("CategoryDropdown");
  if (dropdownContent.style.display === "none") {
    dropdownContent.style.display = "block";
  } else {
    dropdownContent.style.display = "none";
  }
}
</script>

<script>
function toggleBrandDropdown() {
  var dropdownContent = document.getElementById("BrandDropdown");
  if (dropdownContent.style.display === "none") {
    dropdownContent.style.display = "block";
  } else {
    dropdownContent.style.display = "none";
  }
}
</script>
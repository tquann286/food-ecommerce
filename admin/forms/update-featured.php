<tr>
  <td>Đề xuất: </td>
  <td>
    <div class="form-check form-check-inline">
      <input id="featured-yes" <?php if ($featured == "Có") { echo "checked"; } ?> type="radio" name="featured" value="Có" class="form-check-input">
      <label class="form-check-label" for="featured-yes">Có</label>
    </div>

    <div class="form-check form-check-inline">
      <input id="featured-no" <?php if ($featured == "Không") { echo "checked"; } ?> type="radio" name="featured" value="Không" class="form-check-input">
      <label class="form-check-label" for="featured-no">Không</label>
    </div>
  </td>
</tr>

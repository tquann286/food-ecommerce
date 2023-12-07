<tr>
  <td>Kích hoạt: </td>
  <td>
    <div class="form-check form-check-inline">
      <input  class="form-check-input" id="active-yes" <?php if ($active == "Có") { echo "checked"; } ?> type="radio" name="active" value="Có">
      <label class="form-check-label" for="active-yes">Có</label>
    </div>

    <div class="form-check form-check-inline">
      <input id="active-no" <?php if ($active == "Không") { echo "checked"; } ?> type="radio" name="active" value="Không" class="form-check-input" >
      <label class="form-check-label" for="active-no">Không</label>
    </div>
  </td>
</tr>

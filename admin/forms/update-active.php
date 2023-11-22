<tr>
  <td>Active: </td>
  <td>
    <input id="active-yes" <?php if ($active == "Có") {
      echo "checked";
    } ?> type="radio" name="active" value="Có">
    <label for="active-yes">Có</label>

    <input id="active-No" <?php if ($active == "Không") {
      echo "checked";
    } ?> type="radio" name="active" value="Không">
    <label for="active-No">Không</label>
  </td>
</tr>
<tr>
  <td>Featured: </td>
  <td>
    <input id="featured-yes" <?php if ($featured == "Có") {
      echo "checked";
    } ?> type="radio" name="featured" value="Có">
    <label for="featured-yes">Có</label>

    <input id="featured-No" <?php if ($featured == "Không") {
      echo "checked";
    } ?> type="radio" name="featured"
      value="Không">
    <label for="featured-No">Không</label>
  </td>
</tr>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/css/main-style.min.css">
  <link rel="stylesheet" href="assets/css/loading.min.css">
  <title>RegexLab</title>
</head>
<body>
  <div class="container">
    <h1 class="title">Regex Date Creator</h1>
    <p class="description">Just complete the 3 steps below and see the magic<p>
    <form id="date-regex-form">

      <div id="separator-box" class="text-center">
        <h4>1: Choose a separator</h4>
        <div class="form-check form-check-inline">
          <input name="separator" class="form-check-input separator" type="radio" value="1">
          <label class="form-check-label" for="separator-dot">none</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="separator" class="form-check-input separator" type="radio" value="2">
          <label class="form-check-label" for="separator-dash">- (dash)</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="separator" class="form-check-input separator" type="radio" value="3">
          <label class="form-check-label" for="separator-slash">/ (slash)</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="separator" class="form-check-input separator" type="radio" value="4">
          <label class="form-check-label" for="separator-dot">. (dot)</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="separator" class="form-check-input separator" type="radio" value="5">
          <label class="form-check-label" for="separator-dot">any</label>
        </div>
      </div>

      <div class="text-center my-4">
        <h4>2: Select a format</h4>
        <p>Y = Year M = Month D = Day</p>
        <select class="col-4 col-sm-3 m-auto form-control select" name="format">
          <option value="1">Y M D</option>
          <option value="2">Y D M</option>
          <option value="3">D M Y</option>
        </select>
      </div>

      <div class="text-center my-4">
        <h4>3: Inform a Year Interval</h4>
        <div id="box-range" class="row">
          <input id="from" name="from" class="col-4 col-sm-2 ml-auto mr-2 form-control" type="number" min="1900" max="2999" maxlength="4" placeholder="Min: 1900">
          <input id="to" name="to" class="col-4 col-sm-2 mr-auto ml-2 form-control" type="number" min="1900" max="2999" maxlength="4" placeholder="Max: 2900">
          <div id="invalid-range" class="invalid-feedback">Invalid Range</div>
        </div>
      </div>

      <div class="text-center my-4">
        <h4>Optional flags</h4>
        <div class="form-check form-check-inline">
          <input name="flags[]" class="form-check-input separator" type="checkbox" value="f">
          <label class="form-check-label" for="separator-dash">Only full year</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="flags[]" class="form-check-input separator" type="checkbox" value="z">
          <label class="form-check-label" for="separator-slash">Force Leading Zeros</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="flags[]" class="form-check-input separator" type="checkbox" value="g">
          <label class="form-check-label" for="separator-dot">Named Groups</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="flags[]" class="form-check-input separator" type="checkbox" value="b">
          <label class="form-check-label" for="separator-dot">Word Boundary</label>
        </div>
      </div>

      <div class="form-group">
        <label class="label" for="result">Result: </label>
        <div class="input-group">
          <div id="result" class="form-control input result"></div>
            <div id="btn-copy" class="btn-copy" data-toggle="tooltip" data-placement="bottom" title="copy">
              <span class="fas fa-copy icon-btn-copy input-group-addon"></span>
            </div>
        </div>
        <p class="text-right mt-2">Did you find a issue? Please report us at <a href="https://github.com/lopesrichard/regexlab/issues" target="_blank">github</a></p>
      </div>
    </form>
    <br>
    <h2>You may test your regex at: <a href="https://regex101.com/" target="_blank">Regex101</a></h2>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script type="text/javascript" src="../../assets/js/classes/Ajax.min.js"></script>
  <script type="text/javascript" src="../../assets/js/classes/Clipboard.min.js"></script>
  <script type="text/javascript" src="assets/js/main.min.js"></script>
</body>
</html>
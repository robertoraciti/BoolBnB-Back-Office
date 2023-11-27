{{-- 
<!DOCTYPE html>
<html class="use-all-space">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"
    />
    <title>SearchBox</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css"
    />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
  </head>
  <body> --}}
    <script>
      var options = {
        searchOptions: {
          key: "<your-tomtom-API-key>",
          language: "en-GB",
          limit: 5,
        },
        autocompleteOptions: {
          key: "<your-tomtom-API-key>",
          language: "en-GB",
        },
      }
      var ttSearchBox = new tt.plugins.SearchBox(tt.services, options)
      var searchBoxHTML = ttSearchBox.getSearchBoxHTML()
      document.body.append(searchBoxHTML)
    </script>
  {{-- </body>
</html> --}}
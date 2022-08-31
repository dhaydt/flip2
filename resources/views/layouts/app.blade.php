<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>StarterHolic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/assets/img/favicon.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vendor CSS Files -->
    @yield('css')
    @stack('css')
</head>

<body>
        @include('partials._header')
    <!-- ======= Hero Section ======= -->
    <section id="app" class="d-flex align-items-center">
        <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
            @yield('content')
        </div>
    </section><!-- End Hero -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

    </footer><!-- End Footer -->

    <div id="preloader"></div>

    <!-- Vendor JS Files -->

    <!-- Template Main JS File -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/app.js') }}"></script>
        <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
        <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
        <script type="text/javascript">
            const SCOPES = 'https://www.googleapis.com/auth/drive.metadata.readonly';

// TODO(developer): Set to client ID and API key from the Developer Console
const CLIENT_ID = '311253523870-00pjappqk881llbm4gjsemg1i6cnun8l.apps.googleusercontent.com';
const API_KEY = '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';

// TODO(developer): Replace with your own project number from console.developers.google.com.
const APP_ID = '<YOUR_APP_ID>';

let tokenClient;
let accessToken = null;
let pickerInited = false;
let gisInited = false;


document.getElementById('authorize_button').style.visibility = 'hidden';
document.getElementById('signout_button').style.visibility = 'hidden';

/**
 * Callback after api.js is loaded.
 */
function gapiLoaded() {
gapi.load('picker', intializePicker);
}

/**
 * Callback after the API client is loaded. Loads the
 * discovery doc to initialize the API.
 */
function intializePicker() {
pickerInited = true;
maybeEnableButtons();
}

/**
 * Callback after Google Identity Services are loaded.
 */
function gisLoaded() {
tokenClient = google.accounts.oauth2.initTokenClient({
    client_id: CLIENT_ID,
    scope: SCOPES,
    callback: '', // defined later
});
gisInited = true;
maybeEnableButtons();
}

/**
 * Enables user interaction after all libraries are loaded.
 */
function maybeEnableButtons() {
if (pickerInited && gisInited) {
    document.getElementById('authorize_button').style.visibility = 'visible';
}
}

/**
 *  Sign in the user upon button click.
 */
function handleAuthClick() {
tokenClient.callback = async (response) => {
    if (response.error !== undefined) {
    throw (response);
    }
    accessToken = response.access_token;
    document.getElementById('signout_button').style.visibility = 'visible';
    document.getElementById('authorize_button').innerText = 'Refresh';
    await createPicker();
};

if (accessToken === null) {
    // Prompt the user to select a Google Account and ask for consent to share their data
    // when establishing a new session.
    tokenClient.requestAccessToken({prompt: 'consent'});
} else {
    // Skip display of account chooser and consent dialog for an existing session.
    tokenClient.requestAccessToken({prompt: ''});
}
}

/**
 *  Sign out the user upon button click.
 */
function handleSignoutClick() {
if (accessToken) {
    accessToken = null;
    google.accounts.oauth2.revoke(accessToken);
    document.getElementById('content').innerText = '';
    document.getElementById('authorize_button').innerText = 'Authorize';
    document.getElementById('signout_button').style.visibility = 'hidden';
}
}

/**
 *  Create and render a Picker object for searching images.
 */
function createPicker() {
const view = new google.picker.View(google.picker.ViewId.DOCS);
view.setMimeTypes('image/png,image/jpeg,image/jpg');
const picker = new google.picker.PickerBuilder()
    .enableFeature(google.picker.Feature.NAV_HIDDEN)
    .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
    .setDeveloperKey(API_KEY)
    .setAppId(APP_ID)
    .setOAuthToken(accessToken)
    .addView(view)
    .addView(new google.picker.DocsUploadView())
    .setCallback(pickerCallback)
    .build();
picker.setVisible(true);
}

/**
 * Displays the file details of the user's selection.
 * @param {object} data - Containers the user selection from the picker
 */
function pickerCallback(data) {
if (data.action === google.picker.Action.PICKED) {
    document.getElementById('content').innerText = JSON.stringify(data, null, 2);
}
}

        </script>
    @yield('js')
    @stack('js')
</body>

</html>

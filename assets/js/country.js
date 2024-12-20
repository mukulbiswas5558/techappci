$(document).ready(function() {
    const table = $('#countryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${base_url}country/fetch_countries`,
            type: "POST"
        },
        columns: [
            {
                "data": null,
                "name": "id",
                "render": function(data, type, row, meta) {
                    var currentPage = table.page.info().page; // Get current page index
                    var pageLength = table.page.info().length; // Get number of rows per page
                    var serialNumber = currentPage * pageLength + meta.row + 1; // Calculate serial number
                    return serialNumber;
                }
            },
            { data: "id_country", name: "id_country" },
            { data: "country_name", name: "country_name" },
            { data: "initial", name: "initial" },
            {
                "data": "flag",
                "render": function(data) {
                    return `<img src="${data}" alt="Flag" style="width: 40px; height: 25px;">`;
                }
            },
            { data: "continent_name", name: "continent_name" },
            { data: "major_cities", name: "major_cities" },
            { data: "capital", name: "capital" },
            { data: "location", name: "location" },
            { data: "border_shared", name: "border_shared" },
            { data: "area", name: "area" },
            { data: "climate", name: "climate" },
            { data: "topography", name: "topography" },
            { data: "population", name: "population" },
            { data: "ethnic_groups", name: "ethnic_groups" },
            { data: "language", name: "language" },
            { data: "religions", name: "religions" },
            { data: "government_type", name: "government_type" },
            { data: "prime_minister", name: "prime_minister" },
            { data: "president", name: "president" },
            { data: "vice_president", name: "vice_president" },
            { data: "administrative_division", name: "administrative_division" },
            { data: "currency", name: "currency" },
            { data: "gdp", name: "gdp" },
            { data: "gdp_per_capita", name: "gdp_per_capita" },
            { data: "major_industry", name: "major_industry" },
            { data: "exports", name: "exports" },
            { data: "imports", name: "imports" },
            { data: "brief_history", name: "brief_history" },
            { data: "key_historical_events", name: "key_historical_events" },
            { data: "tourist_stat", name: "tourist_stat" },
            { data: "education_system", name: "education_system" },
            { data: "literacy_rate", name: "literacy_rate" },
            { data: "healthcare_system", name: "healthcare_system" },
            { data: "life_expectancy", name: "life_expectancy" },
            { data: "holidays", name: "holidays" },
            { data: "cuisine", name: "cuisine" },
            { data: "sports", name: "sports" },
            { data: "major_attractions", name: "major_attractions" },
            { data: "independance_date", name: "independance_date" },
            { data: "denonym", name: "denonym" },
            { data: "area_rank", name: "area_rank" },
            { data: "population_rank", name: "population_rank" },
            { data: "gdp_rank", name: "gdp_rank" },
            { data: "literacy_rate_rank", name: "literacy_rate_rank" },
            { data: "male_literacy", name: "male_literacy" },
            { data: "female_literacy", name: "female_literacy" },
            { data: "sex_ratio", name: "sex_ratio" },
            { data: "sex_rank", name: "sex_rank" },
            { data: "child_sex_ratio", name: "child_sex_ratio" },
            { data: "child_sex_rank", name: "child_sex_rank" },
            {
                "data": "embelam_image_url",
                "render": function(data) {
                    return `<img src="${data}" alt="Emblem" style="width: 40px; height: 25px;">`;
                }
            },
            { data: "song", name: "song" },
            { data: "bird", name: "bird" },
            { data: "fish", name: "fish" },
            { data: "flower", name: "flower" },
            { data: "fruit", name: "fruit" },
            { data: "mammal", name: "mammal" },
            { data: "tree", name: "tree" },
            { data: "map_link_url", name: "map_link_url" },
            { data: "chief_justice", name: "chief_justice" },
            { data: "latitude", name: "latitude" },
            { data: "longitude", name: "longitude" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
            {
                data: null,
                name: "action",
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div style="display: flex; column-gap: 5px; justify-content: center;">
                            <button class="btn btn-primary edit-btn" 
                                    data-id="${row.id}" 
                                    data-id-country="${row.id_country}" 
                                    data-country-name="${row.country_name}" 
                                    data-initial="${row.initial}" 
                                    data-flag="${row.flag}" 
                                    data-continent-name="${row.continent_name}" 
                                    data-major-cities="${row.major_cities}" 
                                    data-capital="${row.capital}" 
                                    data-location="${row.location}" 
                                    data-border-shared="${row.border_shared}" 
                                    data-area="${row.area}" 
                                    data-climate="${row.climate}" 
                                    data-topography="${row.topography}" 
                                    data-population="${row.population}" 
                                    data-ethnic-groups="${row.ethnic_groups}" 
                                    data-language="${row.language}" 
                                    data-religions="${row.religions}" 
                                    data-government-type="${row.government_type}" 
                                    data-prime-minister="${row.prime_minister}" 
                                    data-president="${row.president}" 
                                    data-vice-president="${row.vice_president}" 
                                    data-administrative-division="${row.administrative_division}" 
                                    data-currency="${row.currency}" 
                                    data-gdp="${row.gdp}" 
                                    data-gdp-per-capita="${row.gdp_per_capita}" 
                                    data-major-industry="${row.major_industry}" 
                                    data-exports="${row.exports}" 
                                    data-imports="${row.imports}" 
                                    data-brief-history="${row.brief_history}" 
                                    data-key-historical-events="${row.key_historical_events}" 
                                    data-tourist-stat="${row.tourist_stat}" 
                                    data-education-system="${row.education_system}" 
                                    data-literacy-rate="${row.literacy_rate}" 
                                    data-healthcare-system="${row.healthcare_system}" 
                                    data-life-expectancy="${row.life_expectancy}" 
                                    data-holidays="${row.holidays}" 
                                    data-cuisine="${row.cuisine}" 
                                    data-sports="${row.sports}" 
                                    data-major-attractions="${row.major_attractions}" 
                                    data-independance-date="${row.independance_date}" 
                                    data-denonym="${row.denonym}" 
                                    data-area-rank="${row.area_rank}" 
                                    data-population-rank="${row.population_rank}" 
                                    data-gdp-rank="${row.gdp_rank}" 
                                    data-literacy-rate-rank="${row.literacy_rate_rank}" 
                                    data-male-literacy="${row.male_literacy}" 
                                    data-female-literacy="${row.female_literacy}" 
                                    data-sex-ratio="${row.sex_ratio}" 
                                    data-sex-rank="${row.sex_rank}" 
                                    data-child-sex-ratio="${row.child_sex_ratio}" 
                                    data-child-sex-rank="${row.child_sex_rank}" 
                                    data-embelam-image-url="${row.embelam_image_url}" 
                                    data-song="${row.song}" 
                                    data-bird="${row.bird}" 
                                    data-fish="${row.fish}" 
                                    data-flower="${row.flower}" 
                                    data-fruit="${row.fruit}" 
                                    data-mammal="${row.mammal}" 
                                    data-tree="${row.tree}" 
                                    data-map-link-url="${row.map_link_url}" 
                                    data-chief-justice="${row.chief_justice}" 
                                    data-latitude="${row.latitude}" 
                                    data-longitude="${row.longitude}" 
                                    data-created-at="${row.created_at}" 
                                    data-updated-at="${row.updated_at}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete-btn" data-id="${row.id}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>`;
                }
            }
        ]
    });
  
    // Edit Button Click
    $('#countryTable').on('click', '.edit-btn', function () {
        const country = $(this).data(); // Get data attributes from the clicked button
        Swal.fire({
            title: 'Edit Country',
            html: `
                <form id="editCountryForm">
                <input type="hidden" class="form-control" id="id" name="id" value="${country.id}">
                    <div class="form-group">
                        <label for="country_name">Country Name</label>
                        <input type="text" class="form-control" id="country_name" name="country_name" value="${country.countryName}">
                    </div>
                    <div class="form-group">
                        <label for="initial">Initial</label>
                        <input type="text" class="form-control" id="initial" name="initial" value="${country.initial}">
                    </div>
                    <div class="form-group">
                    
                        <label for="Flag">Flag</label>
                        <input type="text" class="form-control" id="flag" name="flag" value="${country.flag}">
                    </div>
                        
                    <div class="form-group">
                        <label for="capital">Capital</label>
                        <input type="text" class="form-control" id="capital" name="capital" value="${country.capital}">
                    </div>
                    <div class="form-group">
                        <label for="continent_name">Continent</label>
                        <input type="text" class="form-control" id="continent_name" name="continent_name" value="${country.continentName}">
                    </div>
                    <div class="form-group">
                        <label for="major_cities">Major Cities</label>
                        <input type="text" class="form-control" id="major_cities" name="major_cities" value="${country.majorCities}">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="${country.location}">
                    </div>
                    <div class="form-group">
                        <label for="border_shared">Borders Shared</label>
                        <input type="text" class="form-control" id="border_shared" name="border_shared" value="${country.borderShared}">
                    </div>
                    <div class="form-group">
                        <label for="area">Area (sq km)</label>
                        <input type="number" class="form-control" id="area" name="area" value="${country.area}">
                    </div>
                    <div class="form-group">
                        <label for="climate">Climate</label>
                        <input type="text" class="form-control" id="climate" name="climate" value="${country.climate}">
                    </div>
                    <div class="form-group">
                        <label for="topography">Topography</label>
                        <input type="text" class="form-control" id="topography" name="topography" value="${country.topography}">
                    </div>
                    <div class="form-group">
                        <label for="population">Population</label>
                        <input type="number" class="form-control" id="population" name="population" value="${country.population}">
                    </div>
                    <div class="form-group">
                        <label for="ethnic_groups">Ethnic Groups</label>
                        <input type="text" class="form-control" id="ethnic_groups" name="ethnic_groups" value="${country.ethnicGroups}">
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <input type="text" class="form-control" id="language" name="language" value="${country.language}">
                    </div>
                    <div class="form-group">
                        <label for="religions">Religions</label>
                        <input type="text" class="form-control" id="religions" name="religions" value="${country.religions}">
                    </div>
                    <div class="form-group">
                        <label for="government_type">Government Type</label>
                        <input type="text" class="form-control" id="government_type" name="government_type" value="${country.governmentType}">
                    </div>
                    <div class="form-group">
                        <label for="prime_minister">Prime Minister</label>
                        <input type="text" class="form-control" id="prime_minister" name="prime_minister" value="${country.primeMinister}">
                    </div>
                    <div class="form-group">
                        <label for="president">President</label>
                        <input type="text" class="form-control" id="president" name="president" value="${country.president}">
                    </div>
                    <div class="form-group">
                        <label for="vice_president">Vice President</label>
                        <input type="text" class="form-control" id="vice_president" name="vice_president" value="${country.vicePresident}">
                    </div>
                    <div class="form-group">
                        <label for="administrative_division">Administrative Division</label>
                        <input type="text" class="form-control" id="administrative_division" name="administrative_division" value="${country.administrativeDivision}">
                    </div>
                    <div class="form-group">
                        <label for="currency">Currency</label>
                        <input type="text" class="form-control" id="currency" name="currency" value="${country.currency}">
                    </div>
                    <div class="form-group">
                        <label for="gdp">GDP</label>
                        <input type="number" class="form-control" id="gdp" name="gdp" value="${country.gdp}">
                    </div>
                    <div class="form-group">
                        <label for="gdp_per_capita">GDP per Capita</label>
                        <input type="number" class="form-control" id="gdp_per_capita" name="gdp_per_capita" value="${country.gdpPerCapita}">
                    </div>
                    <div class="form-group">
                        <label for="major_industry">Major Industry</label>
                        <input type="text" class="form-control" id="major_industry" name="major_industry" value="${country.majorIndustry}">
                    </div>
                    <div class="form-group">
                        <label for="exports">Exports</label>
                        <input type="text" class="form-control" id="exports" name="exports" value="${country.exports}">
                    </div>
                    <div class="form-group">
                        <label for="imports">Imports</label>
                        <input type="text" class="form-control" id="imports" name="imports" value="${country.imports}">
                    </div>
                    <div class="form-group">
                        <label for="brief_history">Brief History</label>
                        <input type="text" class="form-control" id="brief_history" name="brief_history" value="${country.briefHistory}">
                    </div>
                    <div class="form-group">
                        <label for="key_historical_events">Key Historical Events</label>
                        <input type="text" class="form-control" id="key_historical_events" name="key_historical_events" value="${country.keyHistoricalEvents}">
                    </div>
                    <div class="form-group">
                        <label for="tourist_stat">Tourist Statistics</label>
                        <input type="text" class="form-control" id="tourist_stat" name="tourist_stat" value="${country.touristStat}">
                    </div>
                    <div class="form-group">
                        <label for="education_system">Education System</label>
                        <input type="text" class="form-control" id="education_system" name="education_system" value="${country.educationSystem}">
                    </div>
                    <div class="form-group">
                        <label for="literacy_rate">Literacy Rate</label>
                        <input type="text" class="form-control" id="literacy_rate" name="literacy_rate" value="${country.literacyRate}">
                    </div>
                    <div class="form-group">
                        <label for="healthcare_system">Healthcare System</label>
                        <input type="text" class="form-control" id="healthcare_system" name="healthcare_system" value="${country.healthcareSystem}">
                    </div>
                    <div class="form-group">
                        <label for="life_expectancy">Life Expectancy</label>
                        <input type="text" class="form-control" id="life_expectancy" name="life_expectancy" value="${country.lifeExpectancy}">
                    </div>
                    <div class="form-group">
                        <label for="holidays">Holidays</label>
                        <input type="text" class="form-control" id="holidays" name="holidays" value="${country.holidays}">
                    </div>
                    <div class="form-group">
                        <label for="cuisine">Cuisine</label>
                        <input type="text" class="form-control" id="cuisine" name="cuisine" value="${country.cuisine}">
                    </div>
                    <div class="form-group">
                        <label for="sports">Sports</label>
                        <input type="text" class="form-control" id="sports" name="sports" value="${country.sports}">
                    </div>
                    <div class="form-group">
                        <label for="major_attractions">Major Attractions</label>
                        <input type="text" class="form-control" id="major_attractions" name="major_attractions" value="${country.majorAttractions}">
                    </div>
                    <div class="form-group">
                        <label for="independance_date">Independence Date</label>
                        <input type="date" class="form-control" id="independance_date" name="independance_date" value="${country.independanceDate}">
                    </div>
                    <div class="form-group">
                        <label for="denonym">Denonym</label>
                        <input type="text" class="form-control" id="denonym" name="denonym" value="${country.denonym}">
                    </div>
                    <div class="form-group">
                        <label for="area_rank">Area Rank</label>
                        <input type="number" class="form-control" id="area_rank" name="area_rank" value="${country.areaRank}">
                    </div>
                    <div class="form-group">
                        <label for="population_rank">Population Rank</label>
                        <input type="number" class="form-control" id="population_rank" name="population_rank" value="${country.populationRank}">
                    </div>
                    <div class="form-group">
                        <label for="gdp_rank">GDP Rank</label>
                        <input type="number" class="form-control" id="gdp_rank" name="gdp_rank" value="${country.gdpRank}">
                    </div>

                    <div class="form-group">
                        <label for="literacy_rate_rank">Literacy Rate Rank</label>
                        <input type="number" class="form-control" id="literacy_rate_rank" name="literacy_rate_rank" value="${country.literacyRateRank}">
                    </div>
                    <div class="form-group">
                        <label for="male_literacy">Male Literacy</label>
                        <input type="text" class="form-control" id="male_literacy" name="male_literacy" value="${country.maleLiteracy}">
                    </div>
                    <div class="form-group">
                        <label for="female_literacy">Female Literacy</label>
                        <input type="text" class="form-control" id="female_literacy" name="female_literacy" value="${country.femaleLiteracy}">
                    </div>
                    <div class="form-group">
                        <label for="sex_ratio">Sex Ratio</label>
                        <input type="text" class="form-control" id="sex_ratio" name="sex_ratio" value="${country.sexRatio}">
                    </div>
                    <div class="form-group">
                        <label for="sex_rank">Sex Rank</label>
                        <input type="number" class="form-control" id="sex_rank" name="sex_rank" value="${country.sexRank}">
                    </div>
                    <div class="form-group">
                        <label for="child_sex_ratio">Child Sex Ratio</label>
                        <input type="text" class="form-control" id="child_sex_ratio" name="child_sex_ratio" value="${country.childSexRatio}">
                    </div>
                    <div class="form-group">
                        <label for="child_sex_rank">Child Sex Rank</label>
                        <input type="number" class="form-control" id="child_sex_rank" name="child_sex_rank" value="${country.childSexRank}">
                    </div>
                    <div class="form-group">
                        <label for="embelam_image_url">Emblem Image URL</label>
                        <input type="text" class="form-control" id="embelam_image_url" name="embelam_image_url" value="${country.embelamImageUrl}">
                    </div>
                    <div class="form-group">
                        <label for="song">Song</label>
                        <input type="text" class="form-control" id="song" name="song" value="${country.song}">
                    </div>
                    <div class="form-group">
                        <label for="bird">Bird</label>
                        <input type="text" class="form-control" id="bird" name="bird" value="${country.bird}">
                    </div>
                    <div class="form-group">
                        <label for="fish">Fish</label>
                        <input type="text" class="form-control" id="fish" name="fish" value="${country.fish}">
                    </div>
                    <div class="form-group">
                        <label for="flower">Flower</label>
                        <input type="text" class="form-control" id="flower" name="flower" value="${country.flower}">
                    </div>
                    <div class="form-group">
                        <label for="fruit">Fruit</label>
                        <input type="text" class="form-control" id="fruit" name="fruit" value="${country.fruit}">
                    </div>
                    <div class="form-group">
                        <label for="mammal">Mammal</label>
                        <input type="text" class="form-control" id="mammal" name="mammal" value="${country.mammal}">
                    </div>
                    <div class="form-group">
                        <label for="tree">Tree</label>
                        <input type="text" class="form-control" id="tree" name="tree" value="${country.tree}">
                    </div>
                    <div class="form-group">
                        <label for="map_link_url">Map Link URL</label>
                        <input type="text" class="form-control" id="map_link_url" name="map_link_url" value="${country.mapLinkUrl}">
                    </div>
                    <div class="form-group">
                        <label for="chief_justice">Chief Justice</label>
                        <input type="text" class="form-control" id="chief_justice" name="chief_justice" value="${country.chiefJustice}">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="${country.latitude}">
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="${country.longitude}">
                    </div>
                    
                    
                    
                </form>
        `,
            showCancelButton: true,
            confirmButtonText: 'Save Changes',
            preConfirm: () => {
                const formData = $('#editCountryForm').serialize(); // Collect form data
                return $.ajax({
                    url: `${base_url}country/update`,
                    type: 'POST',
                    data: formData
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                table.ajax.reload(); // Reload the table data after successful update
                Swal.fire('Updated!', 'Country updated successfully.', 'success');
            }
        });
    });
  
    // Delete Button Click
    $('#countryTable').on('click', '.delete-btn', function () {
        const countryId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `${base_url}country/delete_country/${countryId}`,
                    type: 'POST',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function () {
                        table.ajax.reload();
                        Swal.fire('Deleted!', 'Country has been deleted.', 'success');
                    }
                });
            }
        });
    });
  });
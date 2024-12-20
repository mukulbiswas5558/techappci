$(document).ready(function() {
    const table = $('#stateTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${base_url}state/fetch_states`,
            type: "POST",
            dataSrc: function(json) {
                // Debug the server response
                console.log(json);
                return json.data || []; // Ensure `data` is returned as an array
            }
        },
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'country_id', title: 'Country ID' },
            { data: 'name', title: 'Name' },
            { data: 'slug', title: 'Slug' },
            { data: 'code', title: 'Code' },
            { data: 'created_at', title: 'Created At' },
            { data: 'updated_at', title: 'Updated At' },
            { data: 'continent_name', title: 'Continent Name' },
            { data: 'country_name', title: 'Country Name' },
            { data: 'capital', title: 'Capital' },
            { data: 'brief_history', title: 'Brief History' },
            { data: 'formation_date', title: 'Formation Date' },
            { data: 'language', title: 'Language' },
            { data: 'chief_minister', title: 'Chief Minister' },
            { data: 'governor', title: 'Governor' },
            { data: 'chief_justice', title: 'Chief Justice' },
            { data: 'denonyme', title: 'Demonym' },
            { data: 'area', title: 'Area' },
            { data: 'area_rank', title: 'Area Rank' },
            { data: 'population', title: 'Population' },
            { data: 'population_rank', title: 'Population Rank' },
            { data: 'gdp', title: 'GDP' },
            { data: 'gdp_rank', title: 'GDP Rank' },
            { data: 'per_capita_income', title: 'Per Capita Income' },
            { data: 'per_capita_income_rank', title: 'Per Capita Income Rank' },
            { data: 'literacy', title: 'Literacy' },
            { data: 'literacy_rank', title: 'Literacy Rank' },
            { data: 'male_literacy', title: 'Male Literacy' },
            { data: 'female_literacy', title: 'Female Literacy' },
            { data: 'sex_ratio', title: 'Sex Ratio' },
            { data: 'sex_ratio_rank', title: 'Sex Ratio Rank' },
            { data: 'child_sex_ratio', title: 'Child Sex Ratio' },
            { data: 'child_sex_ratio_rank', title: 'Child Sex Ratio Rank' },
            { data: 'embelam_image', title: 'Emblem Image', render: function(data) {
                return data ? `<img src="${data}" alt="Emblem" style="width:50px;height:50px;">` : 'N/A';
            }},
            { data: 'song', title: 'Song' },
            { data: 'bird', title: 'Bird' },
            { data: 'fish', title: 'Fish' },
            { data: 'flower', title: 'Flower' },
            { data: 'fruit', title: 'Fruit' },
            { data: 'mammal', title: 'Mammal' },
            { data: 'tree', title: 'Tree' },
            { data: 'assembly', title: 'Assembly' },
            { data: 'high_court', title: 'High Court' },
            { data: 'rajya_sava_seat', title: 'Rajya Sabha Seat' },
            { data: 'lok_sava_seat', title: 'Lok Sabha Seat' },
            { data: 'map_link_url', title: 'Map Link', render: function(data) {
                return data ? `<a href="${data}" target="_blank">View Map</a>` : 'N/A';
            }},
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
                                    data-country_id="${row.country_id}" 
                                    data-name="${row.name}" 
                                    data-slug="${row.slug}" 
                                    data-code="${row.code}" 
                                    data-created_at="${row.created_at}" 
                                    data-updated_at="${row.updated_at}" 
                                    data-continent_name="${row.continent_name}" 
                                    data-country_name="${row.country_name}" 
                                    data-capital="${row.capital}" 
                                    data-brief_history="${row.brief_history}" 
                                    data-formation_date="${row.formation_date}" 
                                    data-language="${row.language}" 
                                    data-chief_minister="${row.chief_minister}" 
                                    data-governor="${row.governor}" 
                                    data-chief_justice="${row.chief_justice}" 
                                    data-denonyme="${row.denonyme}" 
                                    data-area="${row.area}" 
                                    data-area_rank="${row.area_rank}" 
                                    data-population="${row.population}" 
                                    data-population_rank="${row.population_rank}" 
                                    data-gdp="${row.gdp}" 
                                    data-gdp_rank="${row.gdp_rank}" 
                                    data-per_capita_income="${row.per_capita_income}" 
                                    data-per_capita_income_rank="${row.per_capita_income_rank}" 
                                    data-literacy="${row.literacy}" 
                                    data-literacy_rank="${row.literacy_rank}" 
                                    data-male_literacy="${row.male_literacy}" 
                                    data-female_literacy="${row.female_literacy}" 
                                    data-sex_ratio="${row.sex_ratio}" 
                                    data-sex_ratio_rank="${row.sex_ratio_rank}" 
                                    data-child_sex_ratio="${row.child_sex_ratio}" 
                                    data-child_sex_ratio_rank="${row.child_sex_ratio_rank}" 
                                    data-embelam_image="${row.embelam_image}" 
                                    data-song="${row.song}" 
                                    data-bird="${row.bird}" 
                                    data-fish="${row.fish}" 
                                    data-flower="${row.flower}" 
                                    data-fruit="${row.fruit}" 
                                    data-mammal="${row.mammal}" 
                                    data-tree="${row.tree}" 
                                    data-assembly="${row.assembly}" 
                                    data-high_court="${row.high_court}" 
                                    data-rajya_sava_seat="${row.rajya_sava_seat}" 
                                    data-lok_sava_seat="${row.lok_sava_seat}" 
                                    data-map_link_url="${row.map_link_url}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete-btn" 
                                    data-id="${row.id}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>`;
                }
            }
        ]
    });

    // Edit Button Click
    $('#stateTable').on('click', '.edit-btn', function () {
        const country = $(this).data(); // Get data attributes from the clicked button
        Swal.fire({
            title: 'Edit Country',
            html: `
                <form id="editStateForm">
                 <input type="hidden" class="form-control" id="id" name="id" value="${country.id}">
        <div class="form-group">
            <label for="country_id">Country ID</label>
            <input type="text" class="form-control" id="country_id" name="country_id" value="${country.country_id}">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="${country.name}">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="${country.slug}">
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="${country.code}">
        </div>
        <div class="form-group">
            <label for="continent_name">Continent Name</label>
            <input type="text" class="form-control" id="continent_name" name="continent_name" value="${country.continent_name}">
        </div>
        <div class="form-group">
            <label for="country_name">Country Name</label>
            <input type="text" class="form-control" id="country_name" name="country_name" value="${country.country_name}">
        </div>
        <div class="form-group">
            <label for="capital">Capital</label>
            <input type="text" class="form-control" id="capital" name="capital" value="${country.capital}">
        </div>
        <div class="form-group">
            <label for="brief_history">Brief History</label>
            <textarea class="form-control" id="brief_history" name="brief_history">${country.brief_history}</textarea>
        </div>
        <div class="form-group">
            <label for="formation_date">Formation Date</label>
            <input type="date" class="form-control" id="formation_date" name="formation_date" value="${country.formation_date}">
        </div>
        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" class="form-control" id="language" name="language" value="${country.language}">
        </div>
        <div class="form-group">
            <label for="chief_minister">Chief Minister</label>
            <input type="text" class="form-control" id="chief_minister" name="chief_minister" value="${country.chief_minister}">
        </div>
        <div class="form-group">
            <label for="governor">Governor</label>
            <input type="text" class="form-control" id="governor" name="governor" value="${country.governor}">
        </div>
        <div class="form-group">
            <label for="chief_justice">Chief Justice</label>
            <input type="text" class="form-control" id="chief_justice" name="chief_justice" value="${country.chief_justice}">
        </div>
        <div class="form-group">
            <label for="denonyme">Denonyme</label>
            <input type="text" class="form-control" id="denonyme" name="denonyme" value="${country.denonyme}">
        </div>
        <div class="form-group">
            <label for="area">Area</label>
            <input type="number" class="form-control" id="area" name="area" value="${country.area}">
        </div>
        <div class="form-group">
            <label for="area_rank">Area Rank</label>
            <input type="number" class="form-control" id="area_rank" name="area_rank" value="${country.area_rank}">
        </div>
        <div class="form-group">
            <label for="population">Population</label>
            <input type="number" class="form-control" id="population" name="population" value="${country.population}">
        </div>
        <div class="form-group">
            <label for="population_rank">Population Rank</label>
            <input type="number" class="form-control" id="population_rank" name="population_rank" value="${country.population_rank}">
        </div>
        <div class="form-group">
            <label for="gdp">GDP</label>
            <input type="number" class="form-control" id="gdp" name="gdp" value="${country.gdp}">
        </div>
        <div class="form-group">
            <label for="gdp_rank">GDP Rank</label>
            <input type="number" class="form-control" id="gdp_rank" name="gdp_rank" value="${country.gdp_rank}">
        </div>
        <div class="form-group">
            <label for="per_capita_income">Per Capita Income</label>
            <input type="number" class="form-control" id="per_capita_income" name="per_capita_income" value="${country.per_capita_income}">
        </div>
        <div class="form-group">
            <label for="literacy">Literacy</label>
            <input type="number" class="form-control" id="literacy" name="literacy" value="${country.literacy}">
        </div>
        <div class="form-group">
            <label for="literacy_rank">Literacy Rank</label>
            <input type="number" class="form-control" id="literacy_rank" name="literacy_rank" value="${country.literacy_rank}">
        </div>
        <div class="form-group">
            <label for="embelam_image">Embelam Image</label>
            <input type="text" class="form-control" id="embelam_image" name="embelam_image" value="${country.embelam_image}">
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
            <label for="tree">Tree</label>
            <input type="text" class="form-control" id="tree" name="tree" value="${country.tree}">
        </div>
                
                    
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Save Changes',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                // Form submission logic here
                const formData = $('#editStateForm').serialize();
                return $.ajax({
                    url: `${base_url}state/update_state`,
                    method: 'POST',
                    data: formData});
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    table.ajax.reload(); // Reload the table data after successful update
                    Swal.fire('Updated!', 'Country updated successfully.', 'success');
                }
            });
        });
      
});

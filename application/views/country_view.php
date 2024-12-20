<style>

	body {
        font-size: 15px;
    }

    /* Paragraphs */
    p {
        font-size: 12px;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    /* Table header */
    thead {
        background-color: #4154f1;
        color: #ffffff;
        font-size: 14px;
    }

    /* Table rows */
    tbody tr {
        font-size: 13px;
    }

    /* DataTable search box styling */
    .dataTables_filter input {
        font-size: 14px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .dataTables_filter {
        margin-bottom: 15px;
    }

    /* Heading styling */
    h2 {
        font-size: 20px;
        color: #333333;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Table container */
    table {
        margin: 0 auto; /* Center align */
        width: 90%;
        border-collapse: collapse;
    }

    /* Padding and margin for cells */
    th, td {
        padding: 8px 12px;
        text-align: left;
    }

	#countryTable .edit-btn i,
	#countryTable .delete-btn i {
		font-size: 12px; /* Adjust size to make the icon smaller */
	}

	#countryTable .edit-btn,
	#countryTable .delete-btn {
		padding: 5px 8px; /* Adjust button padding to make the buttons smaller */
		font-size: 12px;  /* Adjust text size if needed */
		line-height: 1;
	}
	/* #countryTable .edit-btn,.delete-btn{ width: 35px; height: 35px;} */
</style>

<main id="main" class="main">

	<!-- <div class="pagetitle">
		<h1>Dashboard</h1>
		
	</div> -->

	<section class="section dashboard">
		<div class="row">

			<!-- Left side columns -->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Table Country List</h5>

						<!-- Table with hoverable rows -->
						<table id="countryTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID Country</th>
                                    <th>Country Name</th>
                                    <th>Initial</th>
                                    <th>Flag</th>
                                    <th>Continent Name</th>
                                    <th>Major Cities</th>
                                    <th>Capital</th>
                                    <th>Location</th>
                                    <th>Border Shared</th>
                                    <th>Area</th>
                                    <th>Climate</th>
                                    <th>Topography</th>
                                    <th>Population</th>
                                    <th>Ethnic Groups</th>
                                    <th>Language</th>
                                    <th>Religions</th>
                                    <th>Government Type</th>
                                    <th>Prime Minister</th>
                                    <th>President</th>
                                    <th>Vice President</th>
                                    <th>Administrative Division</th>
                                    <th>Currency</th>
                                    <th>GDP</th>
                                    <th>GDP Per Capita</th>
                                    <th>Major Industry</th>
                                    <th>Exports</th>
                                    <th>Imports</th>
                                    <th>Brief History</th>
                                    <th>Key Historical Events</th>
                                    <th>Tourist Statistics</th>
                                    <th>Education System</th>
                                    <th>Literacy Rate</th>
                                    <th>Healthcare System</th>
                                    <th>Life Expectancy</th>
                                    <th>Holidays</th>
                                    <th>Cuisine</th>
                                    <th>Sports</th>
                                    <th>Major Attractions</th>
                                    <th>Independence Date</th>
                                    <th>Denonym</th>
                                    <th>Area Rank</th>
                                    <th>Population Rank</th>
                                    <th>GDP Rank</th>
                                    <th>Literacy Rate Rank</th>
                                    <th>Male Literacy</th>
                                    <th>Female Literacy</th>
                                    <th>Sex Ratio</th>
                                    <th>Sex Rank</th>
                                    <th>Child Sex Ratio</th>
                                    <th>Child Sex Rank</th>
                                    <th>Emblem Image</th>
                                    <th>Song</th>
                                    <th>Bird</th>
                                    <th>Fish</th>
                                    <th>Flower</th>
                                    <th>Fruit</th>
                                    <th>Mammal</th>
                                    <th>Tree</th>
                                    <th>Map Link</th>
                                    <th>Chief Justice</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
						<!-- End Table with hoverable rows -->

					</div>
				</div>
			</div><!-- End Left side columns -->

			<!-- Right side columns -->


		</div>
	</section>

</main><!-- End #main -->
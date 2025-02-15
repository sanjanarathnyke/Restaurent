<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peak Order Times</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <h2>Predicted Peak Order Times</h2>

    <!-- Dropdown for peak order times -->
    <select id="peakTimesDropdown">
        <option value="">Select Peak Time</option>
    </select>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            axios.get('/api/get-peak-times')  // Laravel API route
                .then(response => {
                    let data = response.data;
                    let dropdown = document.getElementById("peakTimesDropdown");

                    data.forEach(item => {
                        let option = document.createElement("option");
                        option.value = item.hour_of_day;
                        option.text = `Hour: ${item.hour_of_day}, Orders: ${item.predicted_orders}`;
                        dropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Error fetching peak times:", error);
                });
        });
    </script>

</body>
</html>

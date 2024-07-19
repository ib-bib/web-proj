<?php
/*
Author:  Ibrahim
Created: June 19
Modified: July 18
*/

session_start();
include_once(__DIR__ . "/controllers/OrderController.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$orderController = new OrderController();
$data = $orderController->getServicesAndTiers();

$services = $data['services'];
$tiers = $data['tiers'];
$serviceTiers = $data['serviceTiers'];

// Retrieve values from session storage
$selectedServiceId = isset($_SESSION['selectedServiceId']) ? $_SESSION['selectedServiceId'] : '';
$selectedTierId = isset($_SESSION['selectedTierId']) ? $_SESSION['selectedTierId'] : '';

// Clear the session values after retrieving them
unset($_SESSION['selectedServiceId']);
unset($_SESSION['selectedTierId']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Handle tracking action
    if (isset($_GET['action']) && $_GET['action'] === 'track') {
        $orderRef = $_POST['order_ref'];
        $result = $orderController->trackOrder($orderRef);

        error_log("Order Reference: $orderRef");
        error_log("Result: " . json_encode($result));

        if ($result) {
            echo json_encode(['success' => true, 'status' => $result['status'], 'order_id' => $result['id']]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    // Handle cancel action
    elseif (isset($_GET['action']) && $_GET['action'] === 'cancel') {
        $orderId = $_POST['order_id'];
        $result = $orderController->cancelOrder($orderId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    // Handle create order action
    else {
        $serviceTierId = $_POST['service_tier_id'];
        $clientEmail = $_POST['client_email'];

        $ref_id = $orderController->createOrder($serviceTierId, $clientEmail);

        if ($ref_id) {
            echo json_encode(['success' => true, 'reference_id' => $ref_id]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Order</title>
</head>

<body>
    <?php $current_page = 'order';
    include('includes/header.inc.php'); ?>
    <main id='order-main'>
        <div class="new-order-card">
            <h2>Place A New Order</h2>
            <div class="new-order-form">
                <!-- Select Service Dropdown -->
                <label for="services">Select Service</label>
                <select name="services" id='services-dropdown'>
                    <option value="">Select a service</option>
                    <?php
                    // Loop through services array to populate options
                    foreach ($services as $service) : ?>
                        <option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Select Pricing Tier Dropdown -->
                <label for="tiers">Select Pricing Tier</label>
                <select name="tiers" id='tiers-dropdown' disabled>
                    <option value="">Select a tier</option>
                    <?php
                    // Loop through tiers array to populate options
                    foreach ($tiers as $tier) : ?>
                        <option value="<?php echo $tier['id']; ?>"><?php echo $tier['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Email Input Field -->
                <label for="email">Enter Your Email Address</label>
                <input type="email" id="email-input" placeholder="example@mail.com" disabled />

                <!-- Order Price Display -->
                <h3 class="order-price">This Service Will Cost:</h3>
                <h3 id="price-display" class="order-price">$00.00</h3>
            </div>

            <!-- Request Button -->
            <div class="new-order-card-button-container">
                <button id="request-button" class="new-order-btn" disabled>Request</button>
            </div>
        </div>

        <!-- Track Order Section -->
        <div class="track-order-card">
            <h2>Already Ordered A Service?</h2>
            <div class="track-order-form">
                <!-- Order Reference Input -->
                <label for="order-ref">Enter Reference ID</label>
                <input name="order-ref" id="order-ref" type="text" placeholder="A-0123-456-789" />

                <!-- Track Status Button -->
                <button id="myBtn" class="track-status-btn">Track Status</button>
            </div>
        </div>
    </main>

    <!-- Modal Section for Order Status -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Order Status Display -->
            <p id="order-status">Order Status: STATUS GOES HERE</p>

            <!-- Cancel Order Button -->
            <button id="cancel-btn" class="cancel-btn" style="display: none;">Cancel Order</button>
        </div>
    </div>
    <?php include('includes/footer.inc.php'); ?>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var trackBtn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        trackBtn.onclick = function() {};

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const servicesDropdown = document.getElementById('services-dropdown');
            const tiersDropdown = document.getElementById('tiers-dropdown');
            const emailInput = document.getElementById('email-input');
            const requestButton = document.getElementById('request-button');
            const priceDisplay = document.getElementById('price-display');
            const cancelBtn = document.getElementById('cancel-btn')

            const serviceTiers = <?php echo json_encode($serviceTiers); ?>;
            const sessionServiceId = sessionStorage.getItem('selectedServiceId');
            const sessionTierId = sessionStorage.getItem('selectedTierId');

            // Populate dropdowns and fields from session storage
            if (sessionServiceId) {
                servicesDropdown.value = sessionServiceId;
                tiersDropdown.disabled = false;

                Array.from(tiersDropdown.options).forEach(option => {
                    if (option.value === "" || serviceTiers.some(st => st.service_id == sessionServiceId && st.tier_id == option.value)) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                });

                if (sessionTierId) {
                    tiersDropdown.value = sessionTierId;
                    emailInput.disabled = false;

                    const selectedServiceTier = serviceTiers.find(st => st.service_id == sessionServiceId && st.tier_id == sessionTierId);
                    if (selectedServiceTier) {
                        const price = parseFloat(selectedServiceTier.price);
                        priceDisplay.textContent = `$${price.toFixed(2)}`;
                    } else {
                        priceDisplay.textContent = "$00.00";
                    }
                }
                sessionStorage.clear()
            }

            // Event listener for services dropdown change
            servicesDropdown.addEventListener('change', function() {
                const serviceId = sessionServiceId ?? this.value;
                if (serviceId) {
                    tiersDropdown.disabled = false;

                    Array.from(tiersDropdown.options).forEach(option => {
                        if (option.value === "" || serviceTiers.some(st => st.service_id == serviceId && st.tier_id == option.value)) {
                            option.style.display = "block";
                        } else {
                            option.style.display = "none";
                        }
                    });

                    tiersDropdown.value = "";
                    emailInput.disabled = true;
                    emailInput.value = "";
                    requestButton.disabled = true;
                    priceDisplay.textContent = "$00.00";
                } else {
                    tiersDropdown.disabled = true;
                    tiersDropdown.value = "";
                    emailInput.disabled = true;
                    emailInput.value = "";
                    requestButton.disabled = true;
                    priceDisplay.textContent = "$00.00";
                }
            });

            // Event listener for tiers dropdown change
            tiersDropdown.addEventListener('change', function() {
                const tierId = this.value;
                const serviceId = servicesDropdown.value;
                if (tierId) {
                    emailInput.disabled = false;

                    const selectedServiceTier = serviceTiers.find(st => st.service_id == serviceId && st.tier_id == tierId);
                    if (selectedServiceTier) {
                        const price = parseFloat(selectedServiceTier.price);
                        priceDisplay.textContent = `$${price.toFixed(2)}`;
                    } else {
                        priceDisplay.textContent = "$00.00";
                    }
                } else {
                    emailInput.disabled = true;
                    emailInput.value = "";
                    requestButton.disabled = true;
                    priceDisplay.textContent = "$00.00";
                }
            });

            // Event listener for email input
            emailInput.addEventListener('input', function() {
                requestButton.disabled = !this.value;
            });

            // Event listener for request button click
            requestButton.addEventListener('click', function() {
                const serviceId = servicesDropdown.value;
                const tierId = tiersDropdown.value;
                const clientEmail = emailInput.value;

                if (serviceId && tierId && clientEmail) {
                    const selectedServiceTier = serviceTiers.find(st => st.service_id == serviceId && st.tier_id == tierId);
                    const serviceTierId = selectedServiceTier.id;

                    requestButton.disabled = true;
                    requestButton.textContent = '...';

                    // Create toast notification
                    const toast = document.createElement('div');
                    toast.className = 'toast';
                    toast.textContent = 'Loading...';

                    const closeButton = document.createElement('button');
                    closeButton.className = 'close-toast-btn';
                    closeButton.textContent = '×';
                    closeButton.onclick = function() {
                        document.body.removeChild(toast);
                    };
                    toast.appendChild(closeButton);

                    document.body.appendChild(toast);

                    // Make request to create order
                    fetch('order.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `service_tier_id=${serviceTierId}&client_email=${clientEmail}`,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toast.textContent = `Request made successfully. Reference ID: ${data.reference_id}`;
                                toast.style.backgroundColor = 'green';
                                toast.appendChild(closeButton); // Append the close button again after changing text
                            } else {
                                toast.textContent = 'Could not make request, please try again later.';
                                toast.style.backgroundColor = 'red';
                                toast.appendChild(closeButton); // Append the close button again after changing text
                            }
                        })
                        .catch(() => {
                            toast.textContent = 'Could not make request, please try again later.';
                            toast.style.backgroundColor = 'red';
                            toast.appendChild(closeButton); // Append the close button again after changing text
                        })
                        .finally(() => {
                            requestButton.textContent = 'Request';
                            requestButton.disabled = false;
                        });
                }
            });

            // Event listener for track order button click
            trackBtn.onclick = function() {
                const orderRef = document.getElementById('order-ref').value;

                if (orderRef) {
                    // Make request to track order
                    fetch('order.php?action=track', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `order_ref=${orderRef}`,
                        })
                        .then(response => response.text())
                        .then(data => {
                            try {
                                const jsonData = JSON.parse(data);
                                console.log('Response:', jsonData); // Log the response
                                const orderStatus = document.getElementById('order-status');
                                const cancelButton = document.getElementById('cancel-btn');

                                if (jsonData.success) {
                                    orderStatus.textContent = 'Order Status: ' + jsonData.status;

                                    if (jsonData.status.toLowerCase() === 'pending') {
                                        cancelButton.style.display = 'block';
                                        cancelButton.dataset.orderId = jsonData.order_id;
                                    } else {
                                        cancelButton.style.display = 'none';
                                    }

                                    modal.style.display = 'block';
                                } else {
                                    alert('Order not found');
                                }
                            } catch (e) {
                                console.error('Parsing error:', e);
                                console.log('Response text:', data);
                                alert('An error occurred, please try again later.');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error); // Log errors
                            alert('An error occurred, please try again later.');
                        });
                }
            };

            // Event listener for cancel order button click
            cancelBtn.onclick = function() {
                const orderId = document.getElementById('cancel-btn').dataset.orderId;

                if (orderId) {
                    // Make request to cancel order
                    fetch('order.php?action=cancel', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `order_id=${orderId}`,
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Cancel Response:', data); // Log the response
                            if (data.success) {
                                alert('Order canceled successfully');
                                modal.style.display = 'none';
                            } else {
                                alert('Could not cancel order, please try again later.');
                            }
                        })
                        .catch((error) => {
                            console.error('Cancel Error:', error); // Log errors
                            alert('An error occurred, please try again later.');
                        });
                }
            };
        });
    </script>
</body>

</html>
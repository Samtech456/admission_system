<?php
session_start();
require 'config/db.php';

// Function to sanitize form inputs
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    if ($action == 'update_application') {
        // Validate and sanitize inputs
        $application_id = $_POST['application_id'] ?? 0;
        $student_id = $_POST['student_id'] ?? 0;
        $first_name = sanitizeInput($_POST['first_name'] ?? '');
        $last_name = sanitizeInput($_POST['last_name'] ?? '');
        $dob = sanitizeInput($_POST['dob'] ?? '');
        $grade_level = sanitizeInput($_POST['grade_level'] ?? '');
        $previous_school = sanitizeInput($_POST['previous_school'] ?? '');
        $notes = sanitizeInput($_POST['notes'] ?? '');

        // TODO: Add more robust validation (e.g., date format, grade level options)

        if (empty($application_id) || empty($first_name) || empty($last_name) || empty($dob) || empty($grade_level)) {
            $_SESSION['update_status'] = ['message' => 'Error: Required fields are missing.', 'type' => 'danger'];
            // If application_id is missing, redirect to applications list, otherwise to edit page or details page
            if (empty($application_id)) {
                header('Location: guardian/applications.php');
            } else {
                // Assuming edit_application.php is the source of update, redirecting back might be better
                // For now, keeping it to view_application_details.php as per original logic, but with correct path
                header('Location: guardian/view_application_details.php?id=' . $application_id);
            }
            exit();
        }

        // TODO: Perform the database update
        $query = "UPDATE students SET first_name = ?, last_name = ?, dob = ?, grade_level = ?, previous_school = ? WHERE id = ?";
        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute([$first_name, $last_name, $dob, $grade_level, $previous_school, $student_id]);

            // Update the applications table with notes
            $query2 = "UPDATE applications SET notes = ? WHERE id = ?";
             $stmt2 = $pdo->prepare($query2);
             $stmt2->execute([$notes, $application_id]);

            $_SESSION['update_status'] = ['message' => 'Application updated successfully!', 'type' => 'success'];
        } catch (PDOException $e) {
            $_SESSION['update_status'] = ['message' => 'Error updating application: ' . $e->getMessage(), 'type' => 'danger'];
        }

        // Redirect to the details page of the application that was attempted to be updated
        if (!empty($application_id)) {
            header('Location: guardian/view_application_details.php?id=' . $application_id);
        } else {
            // Fallback if somehow application_id was lost, though prior checks should prevent this
            header('Location: guardian/applications.php');
        }
        exit();

    } elseif ($action == 'delete_application') {
        $application_id = $_POST['application_id'] ?? 0;
        $guardian_id = $_SESSION['guardian_id'] ?? 0;

        // Check if user is authenticated
        if (!isset($_SESSION['guardian_id'])) {
            $_SESSION['update_status'] = ['message' => 'Error: Authentication required.', 'type' => 'danger'];
            header('Location: guardian/login.php');
            exit();
        }

        if (empty($application_id)) {
            $_SESSION['update_status'] = ['message' => 'Error: Application ID is missing for deletion.', 'type' => 'danger'];
            header('Location: guardian/applications.php');
            exit();
        }

        try {
            // First verify that this application belongs to the guardian
            $verify_query = "SELECT id FROM applications WHERE id = ? AND guardian_id = ?";
            $verify_stmt = $pdo->prepare($verify_query);
            $verify_stmt->execute([$application_id, $guardian_id]);
            
            if (!$verify_stmt->fetch()) {
                $_SESSION['update_status'] = ['message' => 'Error: You do not have permission to delete this application.', 'type' => 'danger'];
                header('Location: guardian/applications.php');
                exit();
            }

            // Start transaction
            $pdo->beginTransaction();

            // Delete associated documents first
            $delete_docs_query = "DELETE FROM documents WHERE application_id = ?";
            $stmt_docs = $pdo->prepare($delete_docs_query);
            $stmt_docs->execute([$application_id]);

            // Get student_id from applications table before deleting
            $get_student_query = "SELECT student_id FROM applications WHERE id = ?";
            $stmt_student = $pdo->prepare($get_student_query);
            $stmt_student->execute([$application_id]);
            $student_id = $stmt_student->fetchColumn();

            // Delete the application
            $delete_application_query = "DELETE FROM applications WHERE id = ? AND guardian_id = ?";
            $stmt_app = $pdo->prepare($delete_application_query);
            $stmt_app->execute([$application_id, $guardian_id]);

            // Delete the student record if it exists
            if ($student_id) {
                $delete_student_query = "DELETE FROM students WHERE id = ?";
                $stmt_student = $pdo->prepare($delete_student_query);
                $stmt_student->execute([$student_id]);
            }

            // Commit transaction
            $pdo->commit();

            $_SESSION['update_status'] = [
                'message' => 'Application and associated data have been successfully deleted.',
                'type' => 'success'
            ];
            header('Location: guardian/applications.php');
            exit();

        } catch (PDOException $e) {
            // Rollback transaction on error
            $pdo->rollBack();
            error_log("Error deleting application: " . $e->getMessage());
            $_SESSION['update_status'] = [
                'message' => 'An error occurred while deleting the application. Please try again or contact support.',
                'type' => 'danger'
            ];
            header('Location: guardian/applications.php');
            exit();
        }


    } else {
        // Invalid action
    $_SESSION['update_status'] = ['message' => 'Invalid action.', 'type' => 'danger'];
    header('Location: guardian/applications.php'); // Corrected path
    exit();
    }
} else {
    // Not a POST request
    header('Location: guardian/applications.php'); // Corrected path
    exit();
}
?>

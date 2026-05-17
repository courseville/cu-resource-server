# TO-DO List for TOR Gaps & Reference Data

## Phase 1: API Endpoint Completion (Low effort, high impact)
- [x] **Task 1.1:** Create `StudentGradeResource` and `StudentGradeController` extending `BaseResourceController`. Register `v1/student-grades` routes. **(Must include corresponding Pest feature tests for the endpoint)**.
- [x] **Task 1.2:** Create `StudentAdvisorResource` and `StudentAdvisorController` extending `BaseResourceController`. Register `v1/student-advisors` routes. **(Must include corresponding Pest feature tests for the endpoint)**.

## Phase 2: Internship Company Normalization (Medium effort)
- [x] **Task 2.1:** Create migration for `companies` table and migration to modify `student_internships` (add `company_id`, drop flat company columns). **(Must include database migration tests)**.
- [x] **Task 2.2:** Create `Company` Eloquent model and update `StudentInternship` model relationships. **(Must include model and relationship unit tests)**.
- [x] **Task 2.3:** Create `CompanyController` and `CompanyResource` for the API, and register `v1/companies` routes. **(Must include corresponding Pest feature tests for the endpoint)**.
- [x] **Task 2.4:** Update Filament UI (`StudentInternshipResource`, create `CompanyResource`) and Data Importers to support the new relationship structure. **(Must include Filament resource and Importer tests)**.

## Phase 3: Data Conflict Detection Mechanism (High effort)
- [x] **Task 3.1:** Create `DataConflict` model and database migration (fields: `model_class`, `model_pk_value`, `data_source_id`, `incoming_data`, `current_data`, `status`, `resolved_by`, `resolved_at`). **(Must include model unit tests)**.
- [x] **Task 3.2:** Refactor `app/Console/Commands/SyncData.php`. Implement diffing logic to detect changes on existing records and write to `data_conflicts` table instead of direct update. **(Must include console command and logic tests for conflict detection)**.
- [x] **Task 3.3:** Build Filament `DataConflictResource` with custom actions to visually diff JSON payloads and resolve conflicts. **(Must include Filament resource action tests)**.

## Phase 4: Reference Data Models for DG (faccode, majorcode, depcode)
- [x] **Task 4.1:** Create `Faculty` model and migration to support data from `dg/faccode.csv`. (Fields: `faccode`, `name_th`, `name_en`). **(Must include model unit tests)**.
- [x] **Task 4.2:** Create `Major` model and migration to support data from `dg/majorcode.csv`. (Fields: `majorcode`, `name_th`, `name_en`). **(Must include model unit tests)**.
- [x] **Task 4.3:** Create `Department` model and migration to support data from `dg/depcode.csv`. (Fields: `depcode`, `name_th`, `name_en`). **(Must include model unit tests)**.
- [x] **Task 4.4:** Create Filament Resources for `Faculty`, `Major`, and `Department`. **(Must include Filament resource tests)**.
- [x] **Task 4.5:** Configure Data Sources, Transformer Mappings, and run synchronization for these reference tables. **(Must include integration tests for the sync process)**.
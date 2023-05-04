```mermaid
classDiagram
    direction RL

    class Regime {
        -id: Integer
        -nomRegime: String
        -duree: Integer
        -type: String
        +getNomRegime(): String
        +setNomRegime(String $nomRegime): void
        +getDuree(): Integer
        +setDuree(Integer $duree): void
        +getType(): String
        +setType(String $type): void
    }

    class Plat {
        -id: Integer 
        -nomPlat: String
        -cout: Decimal 
        -nbrCalories: Integer 
        -ingredients: String
        -regime_id: ID
        +getNomPlat(): String
        +setNomPlat(String $nomPlat): void
        +getCout(): Decimal
        +setCout(Decimal $cout): void
        +getNbrCalories(): Integer
        +setNbrCalories(Integer $nbrCalories): void
        +getIngredients(): String
        +setIngredients(String $ingredients): void
        +getRegime(): ID
        +setRegime(ID $regime_id): void
    }

    Regime "1" -- "1..*" Plat : Possédes

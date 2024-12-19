# Function to find the upper bound for Line structure
def line_upper_bound_and_optimal(nodes):
    # For a line, the upper bound is (n-1)/2 and optimal swaps are the same
    upper_bound = (nodes * (nodes - 1)) / 2
    return upper_bound

# Function to find the upper bound for Star structure
def star_upper_bound_and_optimal(nodes):
    # For a star, the upper bound is 3/2 * (n-1)
    upper_bound = (3 * (nodes - 1)) / 2
    return upper_bound

# Function to calculate the number of reverse pairs (inversions) in the permutation
def calculate_reverse_pairs(permutation):
    n = len(permutation)
    reverse_pairs = 0
    for i in range(n):
        for j in range(i + 1, n):
            if permutation[i] > permutation[j]:
                reverse_pairs += 1
    return reverse_pairs

# Menu-driven program
def menu():
    while True:
        print("\nMenu:")
        print("1. Find upper bound Line structure")
        print("2. Find upper bound Star structure")
        print("3. Find number swaps to sort a permutation in Line")
        print("4. Find number of reverse pairs (swaps) to sort a permutation in Star")
        print("5. Exit")
        
        choice = int(input("Enter your choice: "))
        
        if choice == 1:
            nodes = int(input("Enter the number of nodes: "))
            upper_bound = line_upper_bound_and_optimal(nodes)
            print("Line Structure -> Upper Bound: ", upper_bound)
        
        elif choice == 2:
            nodes = int(input("Enter the number of nodes: "))
            upper_bound = star_upper_bound_and_optimal(nodes)
            print("Star Structure -> Upper Bound: ", upper_bound)
        
        elif choice == 3:
            c =int,input()
            permutation = list(map(int,input("Enter the permutation as space-separated integers: ").split()))
            reverse_pairs = calculate_reverse_pairs(permutation)
            print("Number of swaps required to sort the permutation in Line structure:", reverse_pairs)
        
        elif choice == 4:
            permutation = list(map(int, input("Enter the permutation as space-separated integers: ").split()))
            reverse_pairs = calculate_reverse_pairs(permutation)  # Assuming same logic for star structure
            print(f"Number of reverse pairs (swaps) required to sort the permutation in Star structure: {reverse_pairs}")
        
        elif choice == 5:
            print("Exiting the program.")
            break
        
        else:
            print("Invalid choice. Please try again.")

# Run the menu
menu()

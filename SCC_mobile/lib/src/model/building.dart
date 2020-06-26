class Building {
  String name;
  Map<int, List<String>> floor;

  Building({this.name, this.floor});
}

var B4 = Building(name: 'B4', floor: {
  5: ['501', '502', '503'],
  4: ['401', '402', '403'],
  3: ['301', '302', '303'],
  2: ['201', '202', '203'],
  1: ['101', '102', '103'],
});


